<?php

namespace App\services\socket;

use App\models\connection\connection;

class websocket extends connection {
    
    private $address = '0.0.0.0';
    private $port = 8080;
    private $socketServer ;
    private $client ;

    public function __construct(){
        // Create WebSocket.
        $this->socketServer = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_set_option($this->socketServer , SOL_SOCKET, SO_REUSEADDR, 1);
        socket_bind($this->socketServer , $this->address, $this->port);
        socket_listen($this->socketServer );
        echo "listening to socket port:{$this->port}....";
        
    }

    public function socket_connection($content){

        $members = [];
        $connections = [];
        $connections[] = $this->socketServer;

        while(true){

            $reads = $connections;
            $write = $exceptions = null;

            socket_select($reads,$write,$exceptions,0);
            

            if(in_array($this->socketServer,$reads)){
                $new_connection = socket_accept($this->socketServer );
                $header = socket_read( $new_connection , 1024);
                $this->handshack($header,$this->address,$this->port);

                $connections[] = $new_connection;
                $reply = "connection establish ..! \n";
                $reply = $this->pack_data($reply);
                socket_write($new_connection, $reply, strlen($reply));
               
                $socket_index = array_search($this->socketServer,$reads);
                unset($reads[$socket_index]);
                


                foreach($reads as $key =>  $value){
                    $data = socket_read($value , 1024);
                    
                    if( ! empty( $data ) ){

                        $message = $this->unmask($data);
                        $masked_message = $this->pack_data($message);

                        foreach($connections as $ckey => $cvalue){
                            if($ckey === 0 ) continue;
                            socket_write($cvalue, $message, strlen($masked_message));
                        }
                    }elseif( $data === '' ){

                        echo "disconnect ... -code001";
                        unset($connections[$key]);
                        socket_close($this->socketServer);
                    }
                }
            }
        }
       
    }

    private function unmask($text)
    {
        $lenght = @ord($text[1]) & 127;
        if($lenght === 126){

            $mask = substr($text , 4 ,4);
            $data = substr($text ,8);

        }elseif($lenght === 127){
            
             $mask = substr($text , 10 ,4);
             $data = substr($text ,14);

        }else{

            $mask = substr($text , 2 ,4);
            $data = substr($text ,6);
        }

        $text ='';
        for($i=0 ; $i < strlen($data) ; $i++){
            $text .= $data[$i] ^ $mask[$i % 4];
        }
        return $text;
    }

    private function pack_data($text)
    {
        $b1 = 0x08 | (0x1 & 0x0f);
        $lenght = strlen($text);
        if($lenght <= 125){

            $header = pack('CC' , $b1 , $lenght );

        }elseif($lenght > 125 && $lenght < 65536){
            
            $header = pack('CCn' , $b1 , 126 , $lenght );

        }elseif($lenght > 65536){
            
            $header = pack('CCNN' , $b1 , 127 , $lenght );

        }
        return $header.$text;
    }


    private function handshack($request_header , $address ,$port)
    {
        $headers = [];
        $lines = preg_split('/\r\n\/',$request_header);

        foreach($lines as $line){

            $line = chop($line);
            if(preg_match("/\A(\S+): (.*)\z/",$line , $matches)){
                $headers[$matches[1]] = $matches[2];
            }
        }

        $sec_key = $headers['Sec-WebSocket-Key'];
        $sec_accept = base64_encode(pack(
                'H*',
                sha1($matches[1] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')
            ));
            $response_headers = "HTTP/1.1 101 Switching Protocols\r\n";
            $response_headers .= "Upgrade: websocket\r\n";
            $response_headers .= "Connection: Upgrade\r\n";
            $response_headers .= "Sec-WebSocket-Version: 13\r\n";
            $response_headers .= "Sec-WebSocket-Accept: $sec_accept\r\n\r\n";

            socket_write($this->socketServer, $response_headers, strlen($response_headers));
    }
}





?>
<?php

class VestaAPIConnection {

    // Server credentials
    private $vst_hostname = 'st.tni.ac.th';
    private $vst_username = 'admin';
    private $vst_password = 'Int#105@Fit';
    private $vst_port     = '8083';
    private $vst_returncode = 'yes';
    private $postvars = [];

    public function __construct($args = []){

        $this->postvars = [
            'user'          => $this->vst_username,
            'password'      => $this->vst_password,
            'returncode'    => $this->vst_returncode,
        ];

        foreach($args as $key => $value){
            $this->postvars[$key] = $value;
        }

        //var_dump($this->postvars);
    }

    public function execute () {
        // Send POST query via cURL
        $postdata = http_build_query($this->postvars);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://$this->vst_hostname:$this->vst_port/api/");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
        $answer = curl_exec($curl);

        // Check result
        return($answer == 0)? true : "Query returned error code: " .$answer. "\n";
    }
}
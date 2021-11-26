<?php

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\Fields\CampaignFields;


class FacebookAccount  extends Api{

    private $app_id = "{app-id}";
    private $app_secret = "{appsecret}";
    private $access_token = "{access-token}";
    private $account_id = "act_{{adaccount-id}}";

    public function getSessions(){
        $this->init($this->app_id, $this->app_secret,$this->access_token);

        $account = new AdAccount($this->account_id);
        return $account;
    }

    public function showCampaigns($account){
        $cursor = $account->getCampaigns();
        foreach ($cursor as $campaign) {
            echo $campaign->{CampaignFields::NAME}.PHP_EOL;
        }
    }

}
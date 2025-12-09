<?php


namespace AcMarche\Theme\Lib;


use MailchimpMarketing\ApiClient;

class MailChimp
{
    public ApiClient $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient();

        $this->apiClient->setConfig(
            [
                'apiKey' => $_ENV['MAILCHIMP_KEY'],
                'server' => $_ENV['MAILCHIMP_SERVER'],
            ]
        );

        //  $response  = $this->apiClient->ping->get();
        //   $this->apiClient->setDebug(true);
    }

    public function getCampaings(): array
    {
        $data = [];
        $list = $this->apiClient->campaigns->list(
            null,
            null,
            15,
            0,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            'send_time',
            'DESC'
        );
        $i    = 0;
        foreach ($list->campaigns as $campaing) {
            $data[$i]['id'] = $campaing->id;
            $data[$i]['archive_url'] = $campaing->archive_url;
            $data[$i]['send_time'] = $campaing->send_time; //2021-05-12T15:10:19+00:00
            $settings = $campaing->settings;
            $data[$i]['title'] = $settings->title;
            $i++;
        }

        return $data;
    }
}

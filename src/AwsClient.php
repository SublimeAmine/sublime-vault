<?php
namespace SublimeSkinz\SublimeVault;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class AwsClient
{
    /**
     * Fetch appRole credentials from AWS bucket
     * 
     * @param string $bucketName
     * @param string $credsPath
     * @return json|null
     */
    public function fetchAppRoleCreds($bucketName, $credsPath)
    {
        try {
            $s3 = S3Client::factory([
                    "region" => "eu-west-1",
                    "version" => "2006-03-01"
            ]);

            $response = $s3->getObject([
                "Bucket" => $bucketName,
                "Key" => $credsPath
            ]);

            return json_decode($response["Body"]);
        } catch (S3Exception $e) {
            //echo $e->getMessage() . "\n";       
            return null;
        }
    }
}
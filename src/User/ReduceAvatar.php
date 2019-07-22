<?php

namespace Yosmy\Virtual\User;

use Yosmy\Http;

/**
 * @di\service({private: true})
 */
class ReduceAvatar
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var Http\ExecuteRequest
     */
    private $executeRequest;

    /**
     * @di\arguments({
     *     uri: "%imaginary_uri%",
     * })
     *
     * @param string $uri
     * @param Http\ExecuteRequest $executeRequest
     */
    public function __construct(
        string $uri,
        Http\ExecuteRequest $executeRequest
    ) {
        $this->uri = $uri;
        $this->executeRequest = $executeRequest;
    }

    /**
     * @param string $image
     * @param string $width
     *
     * @return string
     *
     * @throws Http\Exception
     */
    public function reduce(
        string $image,
        string $width
    ) {
        [$type, $data] = explode(',', $image);

        $image = tempnam(sys_get_temp_dir(), 'avatar');

        file_put_contents($image, base64_decode($data));

        unset($data);

        try {
            $response = $this->executeRequest->execute(
                'post',
                sprintf('%s/thumbnail?width=%s', $this->uri, $width),
                [
                    'multipart' => [
                        [
                            'name' => 'file',
                            'contents' => fopen($image, 'r'),
                        ]
                    ]
                ]
            );
        } catch (Http\Exception $e) {
            throw $e;
        }

        unlink($image);

        $data = base64_encode((string) $response->getRawBody());

        $image = join(',', [$type, $data]);

        return $image;
    }
}

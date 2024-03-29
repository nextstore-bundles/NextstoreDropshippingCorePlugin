<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\EventListener;

use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Core\Model\ImageInterface;
use Sylius\Component\Core\Uploader\ImageUploaderInterface;
use Webmozart\Assert\Assert;

final class ImageUploadListener
{
    /**
     * @var ImageUploaderInterface
     */
    private $uploader;

    public function __construct(ImageUploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    public function uploadImage(ResourceControllerEvent $event): void
    {
        $image = $event->getSubject();
        Assert::isInstanceOf($image, ImageInterface::class);

        if ($image->hasFile()) {
            $this->uploader->upload($image);
        }

        if (null === $image->getPath()) {
            $event->stop('nextstore_sylius_dropshipping_core.online_store_image.upload_error');
        }
    }
}

<?php declare(strict_types=1);

namespace Serializer;

use App\Entity\Custom;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CustomNormalizer implements NormalizerInterface
{
    public function __construct(
        #[Autowire(service: 'serializer.normalizer.object')]
        private readonly NormalizerInterface $normalizer,
        private UrlGeneratorInterface $router,
    ) {
    }

    /**
     * @param mixed $custom
     * @param string|null $format
     * @param array $context
     * @return array
     * @throws ExceptionInterface
     */
    public function normalize(mixed $custom, ?string $format = null, array $context = []): array
    {
        $data = $this->normalizer->normalize($custom, $format, $context);

        // Here, add, edit, or delete some data:
        $data['href']['self'] = $this->router->generate('custom_show', [
            'id' => $custom->getId(),
        ], UrlGeneratorInterface::ABSOLUTE_URL);

        return $data;
    }

    /**
     * @param mixed $data
     * @param string|null $format
     * @param array $context
     * @return bool
     */
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof Custom;
    }


    public function getSupportedTypes(?string $format): array
    {
        return [
            'object' => null,             // Doesn't support any classes or interfaces
            '*' => false,                 // Supports any other types, but the result is not cacheable
            CustomClass::class => true, // Supports MyCustomClass and result is cacheable
        ];
    }
}
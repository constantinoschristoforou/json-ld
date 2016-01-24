<?php

namespace JsonLd;

use InvalidArgumentException;
use JsonLd\Contracts\ContextTypeInterface;

class Context
{
    /**
     * Context type
     *
     * @var ContextTypeInterface
     */
    protected $context = null;

    /**
     * Create a new Context instance
     *
     * @param string $context
     * @param array  $data
     */
    public function __construct($context, array $data = [])
    {
        $this->context = $this->getContextType($context, $data);
    }

    /**
     * Present given data as a JSON-LD object.
     *
     * @param  string $context
     * @param  array  $data
     * @return string
     */
    public static function create($context, array $data = [])
    {
        return new static($context, $data);
    }

    /**
     * Return the array of context properties.
     *
     * @return array
     */
    public function getProperties()
    {
        return array_filter($this->context->getProperties());
    }

    /**
     * Generate the JSON-LD script tag.
     *
     * @return string
     */
    public function generate()
    {
        $properties = $this->getProperties();

        return $properties ? "<script type=\"application/ld+json\">".json_encode($properties)."</script>" : '';
    }

    /**
     * Return requested context instance.
     *
     * @param  string $name
     * @param  array  $data
     *
     * @throws InvalidArgumentException
     *
     * @return ContextTypeInterface
     */
    private function getContextType($name, array $data = [])
    {
        switch ($name) {
            case 'event':
                return new ContextTypes\Event($data);
                break;
            case 'place':
                return new ContextTypes\Place($data);
                break;
            case 'address':
                return new ContextTypes\PostalAddress($data);
                break;
            case 'business':
                return new ContextTypes\LocalBusiness($data);
                break;
            case 'breadcrumbs':
                return new ContextTypes\BreadcrumbList($data);
                break;
            case 'review':
                return new ContextTypes\Review($data);
                break;
            case 'geo':
                return new ContextTypes\GeoCoordinates($data);
                break;
            case 'person':
                return new ContextTypes\Person($data);
                break;
            case 'organization':
                return new ContextTypes\Organization($data);
                break;
            case 'article':
                return new ContextTypes\Article($data);
                break;
            case 'news_article':
                return new ContextTypes\NewsArticle($data);
                break;
            case 'blog_posting':
                return new ContextTypes\BlogPosting($data);
                break;
            case 'search_box':
                return new ContextTypes\SearchBox($data);
                break;
            case 'website':
                return new ContextTypes\WebSite($data);
                break;
            case 'local_business':
                return new ContextTypes\LocalBusiness($data);
                break;
            default:
                throw new InvalidArgumentException(sprintf('Undefined context type: "%s"', $name));
        }
    }

    /**
     * Return script tag.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->generate();
    }
}

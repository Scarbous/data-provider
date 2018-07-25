<?php


namespace Xervice\DataProvider\DataProvider;


class AnyDataProvider implements DataProviderInterface
{
    /**
     * @var string
     */
    private $className;

    /**
     * @var \Xervice\DataProvider\DataProvider\DataProviderInterface
     */
    private $dataProvider;

    /**
     * AnyDataProvider constructor.
     *
     * @param \Xervice\DataProvider\DataProvider\DataProviderInterface $dataProvider
     */
    public function __construct(\Xervice\DataProvider\DataProvider\DataProviderInterface $dataProvider = null)
    {
        if ($dataProvider) {
            $this->className = \get_class($dataProvider);
            $this->dataProvider = $dataProvider;
        }
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @param string $className
     */
    public function setClassName(string $className): void
    {
        $this->className = $className;
    }

    /**
     * @return \Xervice\DataProvider\DataProvider\DataProviderInterface
     */
    public function getDataProvider(): ?\Xervice\DataProvider\DataProvider\DataProviderInterface
    {
        return $this->dataProvider;
    }

    /**
     * @param \Xervice\DataProvider\DataProvider\DataProviderInterface $dataProvider
     */
    public function setDataProvider(\Xervice\DataProvider\DataProvider\DataProviderInterface $dataProvider): void
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'class' => $this->className,
            'dataprovider' => $this->dataProvider ? $this->dataProvider->toArray() : []
        ];
    }

    /**
     * @param array $data
     */
    public function fromArray(array $data): void
    {
        if (isset($data['class']) && isset($data['dataprovider'])) {
            $this->className = $data['class'];
            $this->dataProvider = new $this->className();
            $this->dataProvider->fromArray($data['dataprovider']);
        }
    }


}
<?php


namespace ShoppingCart\Model;


use phpDocumentor\Reflection\Types\This;

class Cart
{
    private $content; // CartItems array


    // itemId
    //quantity
    /**
     * Cart constructor.
     * @param $orderId
     */
    public function __construct()
    {
        session_start();
        $this->content = array();
    }


    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * @param array $content
     */
    public function setContent(array $content): void
    {
        $this->content = $content;
    }

    public function addItemInCart(CartItem $cartItem)
    {
        array_push($this->content, $cartItem);
        exit();
    }

    public function updateItemInCart(CartItem $cartItem){
        foreach ($this->content as $item){
            if ($item->getItemId() == $cartItem->getItemId()){
                $item->setQuantity($cartItem->getQuantity());
            }
        }
    }

    public function deleteItemInCart(CartItem $cartItem){
        for ($i = 0;$i<$this->content ; ++$i){
            if ($this->content[$i]->getItemId() == $cartItem->getItemId()){
                unset($this->content[$i]);
            }
        }
    }

    public function getItemsAmount(): int
    {
        return count($this->content);
    }
}
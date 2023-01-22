<?php

declare(strict_types=1);


namespace protocol;


use client\Client;

class InteractPacket extends DataPacket{
	public const NETWORK_ID = ProtocolInfo::INTERACT_PACKET;

	public const ACTION_RIGHT_CLICK = 1;
	public const ACTION_LEFT_CLICK = 2;
	public const ACTION_LEAVE_VEHICLE = 3;
	public const ACTION_MOUSEOVER = 4;

	public const ACTION_OPEN_INVENTORY = 6;

	public $action;
	public $target;
	private $y = 0;
	private $x = 0;
	private $z = 0;

	function decodePayload() : void{
		$this->action = $this->getByte();
		$this->target = $this->getEntityRuntimeId();

		if($this->action === self::ACTION_MOUSEOVER){
			$this->x = $this->getLFloat();
			$this->y = $this->getLFloat();
			$this->z = $this->getLFloat();
		}
	}

	function encodePayload() : void{
		$this->putByte($this->action);
		$this->putEntityRuntimeId($this->target);

		if($this->action === self::ACTION_MOUSEOVER){
			$this->putLFloat($this->x);
			$this->putLFloat($this->y);
			$this->putLFloat($this->z);
		}
	}
}
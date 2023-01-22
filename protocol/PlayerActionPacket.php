<?php

declare(strict_types=1);


namespace protocol;


class PlayerActionPacket extends DataPacket{
	public const NETWORK_ID = ProtocolInfo::PLAYER_ACTION_PACKET;

	public const ACTION_START_BREAK = 0;
	public const ACTION_ABORT_BREAK = 1;
	public const ACTION_STOP_BREAK = 2;


	const ACTION_GET_UPDATED_BLOCK = 3;
	const ACTION_DROP_ITEM = 4;
	const ACTION_STOP_SLEEPING = 5;
	const ACTION_RESPAWN = 6;
	const ACTION_JUMP = 7;
	const ACTION_START_SPRINT = 8;
	const ACTION_STOP_SPRINT = 9;
	const ACTION_START_SNEAK = 10;
	const ACTION_STOP_SNEAK = 11;
	const ACTION_DIMENSION_CHANGE_REQUEST = 12; //sent when dying in different dimension
	const ACTION_DIMENSION_CHANGE_ACK = 13; //sent when spawning in a different dimension to tell the server we spawned
	const ACTION_START_GLIDE = 14;
	const ACTION_STOP_GLIDE = 15;
	const ACTION_BUILD_DENIED = 16;
	const ACTION_CONTINUE_BREAK = 17;

	const ACTION_SET_ENCHANTMENT_SEED = 19;

	const ACTION_RELEASE_ITEM = 99999; //TODO REMOVE

	public $entityRuntimeId;
	public $action;
	public $x;
	public $y;
	public $z;
	public $face;

	function decodePayload() : void{
		$this->entityRuntimeId = $this->getEntityRuntimeId();
		$this->action = $this->getVarInt();
		$this->getBlockPosition($this->x, $this->y, $this->z);
		$this->face = $this->getVarInt();
	}

	function encodePayload() : void{
		$this->putEntityRuntimeId($this->entityRuntimeId);
		$this->putVarInt($this->action);
		$this->putBlockPosition($this->x, $this->y, $this->z);
		$this->putVarInt($this->face);
	}
}
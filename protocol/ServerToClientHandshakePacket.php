<?php

declare(strict_types=1);


namespace protocol;


class ServerToClientHandshakePacket extends DataPacket{
	public const NETWORK_ID = ProtocolInfo::SERVER_TO_CLIENT_HANDSHAKE_PACKET;

	/** @var string */
	public $jwt;

	public function canBeSentBeforeLogin() : bool{
		return true;
	}

	public function decodePayload() : void{
		$this->jwt = $this->getString();
	}

	public function encodePayload() : void{
		$this->putString($this->jwt);
	}
}
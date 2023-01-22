<?php

declare(strict_types=1);


namespace protocol;


use pocketmine\math\Vector3;

class StartGamePacket extends DataPacket{
	public const NETWORK_ID = ProtocolInfo::START_GAME_PACKET;

	public $entityUniqueId;
	public $entityRuntimeId;
	public $playerGamemode;
	/** @var Vector3 */
	public $playerPosition;
	public $pitch;
	public $yaw;
	public $seed;
	public $dimension;
	public $generator = 1; //default infinite - 0 old, 1 infinite, 2 flat
	public $worldGamemode;
	public $difficulty;
	public $spawnX;
	public $spawnY;
	public $spawnZ;
	public $hasAchievementsDisabled = true;
	public $dayCycleStopTime = -1; //-1 = not stopped, any positive value = stopped at that time
	public $eduMode = false;
	public $rainLevel;
	public $lightningLevel;
	public $commandsEnabled;
	public $isTexturePacksRequired = true;
	public $gameRules = []; //TODO: implement this
	public $levelId = ""; //base64 string, usually the same as world folder name in vanilla
	public $worldName;
	public $premiumWorldTemplateId = "";
	public $unknownBool = false;
	public $currentTick = 0;
	private $isMultiplayerGame = true;
	private $hasLANBroadcast = false;
	private $hasXboxLiveBroadcast = false;
	private $hasBonusChestEnabled = false;
	private $hasStartWithMapEnabled = false;
	private $hasTrustPlayersEnabled = false;
	private $defaultPlayerPermission = 0;
	private $xboxLiveBroadcastMode = 0;
	private $unknownVarInt = 0;

	public function decodePayload() : void{
		$this->entityUniqueId = $this->getEntityUniqueId();
		$this->entityRuntimeId = $this->getEntityRuntimeId();
		$this->playerGamemode = $this->getVarInt();
		$this->playerPosition = $this->getVector3();
		$this->pitch = $this->getLFloat();
		$this->yaw = $this->getLFloat();
		$this->seed = $this->getVarInt();
		$this->dimension = $this->getVarInt();
		$this->generator = $this->getVarInt();
		$this->worldGamemode = $this->getVarInt();
		$this->difficulty = $this->getVarInt();
		$this->getBlockPosition($this->spawnX, $this->spawnY, $this->spawnZ);
		$this->hasAchievementsDisabled = $this->getBool();
		$this->dayCycleStopTime = $this->getVarInt();
		$this->eduMode = $this->getBool();
		$this->rainLevel = $this->getLFloat();
		$this->lightningLevel = $this->getLFloat();
		$this->commandsEnabled = $this->getBool();
		$this->isTexturePacksRequired = $this->getBool();
		//$this->gameRules = $this->getGameRules();
		//$this->levelId = $this->getString();
		//$this->worldName = $this->getString();
		//$this->premiumWorldTemplateId = $this->getString();
		//$this->unknownBool = $this->getBool();
		//$this->currentTick = $this->getLLong();
	}

	public function encodePayload() : void{
		$this->putEntityUniqueId($this->entityUniqueId);
		$this->putEntityRuntimeId($this->entityRuntimeId);
		$this->putVarInt($this->playerGamemode);
		$this->putVector3($this->playerPosition);
		$this->putLFloat($this->pitch);
		$this->putLFloat($this->yaw);
		//Level settings
		$this->putVarInt($this->seed);
		$this->putVarInt($this->dimension);
		$this->putVarInt($this->generator);
		$this->putVarInt($this->worldGamemode);
		$this->putVarInt($this->difficulty);
		$this->putBlockPosition($this->spawnX, $this->spawnY, $this->spawnZ);
		$this->putBool($this->hasAchievementsDisabled);
		$this->putVarInt(-1);
		$this->putBool($this->eduMode);
		$this->putLFloat($this->rainLevel);
		$this->putLFloat($this->lightningLevel);
		$this->putBool($this->isMultiplayerGame);
		$this->putBool($this->hasLANBroadcast);
		$this->putBool($this->hasXboxLiveBroadcast);
		$this->putBool($this->commandsEnabled);
		$this->putBool($this->isTexturePacksRequired);
		$this->putGameRules($this->gameRules);
		$this->putBool($this->hasBonusChestEnabled);
		$this->putBool($this->hasStartWithMapEnabled);
		$this->putBool($this->hasTrustPlayersEnabled);
		$this->putVarInt($this->defaultPlayerPermission);
		$this->putVarInt($this->xboxLiveBroadcastMode);
		$this->putString($this->levelId);
		$this->putString($this->worldName);
		$this->putString($this->premiumWorldTemplateId);
		$this->putBool($this->unknownBool);
		$this->putLLong($this->currentTick);
		$this->putVarInt($this->unknownVarInt);
	}
}
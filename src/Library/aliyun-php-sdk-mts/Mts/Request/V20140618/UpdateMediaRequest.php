<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
namespace Mts\Request\V20140618;

class UpdateMediaRequest extends \RpcAcsRequest
{
	function  __construct()
	{
		parent::__construct("Mts", "2014-06-18", "UpdateMedia", "mts", "openAPI");
		$this->setMethod("POST");
	}

	private  $coverURL;

	private  $resourceOwnerId;

	private  $resourceOwnerAccount;

	private  $cateId;

	private  $ownerAccount;

	private  $description;

	private  $ownerId;

	private  $mediaId;

	private  $title;

	private  $tags;

	public function getCoverURL() {
		return $this->coverURL;
	}

	public function setCoverURL($coverURL) {
		$this->coverURL = $coverURL;
		$this->queryParameters["CoverURL"]=$coverURL;
	}

	public function getResourceOwnerId() {
		return $this->resourceOwnerId;
	}

	public function setResourceOwnerId($resourceOwnerId) {
		$this->resourceOwnerId = $resourceOwnerId;
		$this->queryParameters["ResourceOwnerId"]=$resourceOwnerId;
	}

	public function getResourceOwnerAccount() {
		return $this->resourceOwnerAccount;
	}

	public function setResourceOwnerAccount($resourceOwnerAccount) {
		$this->resourceOwnerAccount = $resourceOwnerAccount;
		$this->queryParameters["ResourceOwnerAccount"]=$resourceOwnerAccount;
	}

	public function getCateId() {
		return $this->cateId;
	}

	public function setCateId($cateId) {
		$this->cateId = $cateId;
		$this->queryParameters["CateId"]=$cateId;
	}

	public function getOwnerAccount() {
		return $this->ownerAccount;
	}

	public function setOwnerAccount($ownerAccount) {
		$this->ownerAccount = $ownerAccount;
		$this->queryParameters["OwnerAccount"]=$ownerAccount;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;
		$this->queryParameters["Description"]=$description;
	}

	public function getOwnerId() {
		return $this->ownerId;
	}

	public function setOwnerId($ownerId) {
		$this->ownerId = $ownerId;
		$this->queryParameters["OwnerId"]=$ownerId;
	}

	public function getMediaId() {
		return $this->mediaId;
	}

	public function setMediaId($mediaId) {
		$this->mediaId = $mediaId;
		$this->queryParameters["MediaId"]=$mediaId;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
		$this->queryParameters["Title"]=$title;
	}

	public function getTags() {
		return $this->tags;
	}

	public function setTags($tags) {
		$this->tags = $tags;
		$this->queryParameters["Tags"]=$tags;
	}
	
}
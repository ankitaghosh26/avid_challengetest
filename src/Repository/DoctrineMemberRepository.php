<?php

namespace Avid\CandidateChallenge\Repository;

use Avid\CandidateChallenge\Model\Address;
use Avid\CandidateChallenge\Model\Email;
use Avid\CandidateChallenge\Model\Height;
use Avid\CandidateChallenge\Model\Member;
use Avid\CandidateChallenge\Model\Weight;
use Doctrine\DBAL\Types\Type;

/**
 * @author Kevin Archer <kevin.archer@avidlifemedia.com>
 */
final class DoctrineMemberRepository extends DoctrineRepository implements MemberRepository
{
    const CLASS_NAME = __CLASS__;
    const TABLE_NAME = 'members';
    const ALIAS = 'member';

    /**
     * @param Member $member
     *
     * @return int Affected rows
     */
    public function add($member)
    {  
      $connection_local= $this->getConnection();
	  $member_array=$this->extractData($member);
	  $member_type=$this->getDataTypes();
	
	  $rows_inserted= $connection_local->insert($this->getTableName(), $member_array, $member_type);
	  return($rows_inserted);
    }

    /**
     * @param Member $member
     *
     * @return int Affected rows
     */
    public function update($member)
    {
        
		$connection_local= $this->getConnection();
	  	$member_array=$this->extractData($member);
	  	$member_type=$this->getDataTypes();
		$identifier = array('username'=>$member_array['username']);
		$rows_inserted= $connection_local->update($this->getTableName(), $member_array, $identifier, $member_type);
		return $rows_inserted;
    }

    /**
     * @param Member $member
     *
     * @return int
     */
    public function remove($member)
    {
        $connection_local= $this->getConnection();
	  	$member_array=$this->extractData($member);
		$identifier = array('username'=>$member_array['username']);
		$rows_inserted= $connection_local->delete($this->getTableName(), $identifier);
		return $rows_inserted;
    }

    /**
     * @param string $username
     *
     * @return Member|null
     */
    public function findByUsername($username)
    {
		$connection_localfetchall= $this->getConnection();
		$qb1 = $this->getBaseQuery();
		$qb1->where("username LIKE '%".$username."%'");
		$passqb1 = $this->execute($qb1);
		$qb = $connection_localfetchall->fetchAssoc($passqb1->queryString,array());
		if(is_array($qb))
		$changed_member= $this->hydrate($qb);
		else
		$changed_member=null;
		return $changed_member;
    }

    /**
     * @param string $keyword
     * @param int $first
     * @param int $max
     *
     * @return Member[]
     */
    public function search($keyword, $first = 0, $max = null)
    {
        
		$connection_localfetchall= $this->getConnection();
		$qb1 = $this->getBaseQuery();
		$qb1->where("username LIKE '%".$keyword."%'");
		$passqb1 = $this->execute($qb1);
		$qb = $connection_localfetchall->fetchAll($passqb1->queryString,array());
		$changed_member= $this->hydrateAll($qb);
		return $changed_member;
    }

    /**
     * @param string $keyword
     *
     * @return int
     */
    public function getSearchCount($keyword)
    {
        $connection_localfetchall= $this->getConnection();
		$qb1 = $this->getBaseQuery();
		$qb1->where("username LIKE '%".$keyword."%'");
		$passqb1 = $this->execute($qb1);
		$qb = $connection_localfetchall->fetchAll($passqb1->queryString,array());
		return count($qb);
    }

    /**
     * @return int
     */
    public function count()
    {
        $connection_localfetchall= $this->getConnection();
	    $qb1 = $this->getBaseQuery();
	    $passqb1 = $this->execute($qb1);
	    $qb = $connection_localfetchall->fetchAll($passqb1->queryString,array());
	    return count($qb);
    }

    /**
     * @param int $first
     * @param int $max
     *
     * @return object
     */
    public function findAll($first = 0, $max = null)
    {
	  $connection_localfetchall= $this->getConnection();
	  $qb1 = $this->getBaseQuery($first,$max);
	  $passqb1 = $this->execute($qb1);
	  $qb = $connection_localfetchall->fetchAll($passqb1->queryString,array());
	  $changed_member= $this->hydrateAll($qb);
	  return $changed_member;
	  // return [];
    }

    /**
     * @param array $row
     *
     * @return Member
     */
    protected function hydrate(array $row)
    {
        return new Member(
            $row['username'],
            $row['password'],
            new Address($row['country'], $row['province'], $row['city'], $row['postal_code']),
            new \DateTime($row['date_of_birth']),
            $row['limits'],
            new Height($row['height']),
            new Weight($row['weight']),
            $row['body_type'],
            $row['ethnicity'],
            new Email($row['email'])
        );
    }

    /**
     * @return string
     */
    protected function getTableName()
    {
        return self::TABLE_NAME;
    }

    /**
     * @return string
     */
    protected function getAlias()
    {
        return self::ALIAS;
    }

    /**
     * @param Member $member
     *
     * @return array
     */
    private function extractData($member)
    {
        return [
            'username' => $member->getUsername(),
            'password' => $member->getPassword(),
            'country' => $member->getAddress()->getCountry(),
            'province' => $member->getAddress()->getProvince(),
            'city' => $member->getAddress()->getCity(),
            'postal_code' => $member->getAddress()->getPostalCode(),
            'date_of_birth' => $member->getDateOfBirth(),
            'limits' => $member->getLimits(),
            'height' => $member->getHeight(),
            'weight' => $member->getWeight(),
            'body_type' => $member->getBodyType(),
            'ethnicity' => $member->getEthnicity(),
            'email' => $member->getEmail(),
        ];
    }

    /**
     * @return array
     */
    private function getDataTypes()
    {
        return [
            Type::STRING,
            Type::STRING,
            Type::STRING,
            Type::STRING,
            Type::STRING,
            Type::STRING,
            Type::DATE,
            Type::STRING,
            Type::STRING,
            Type::STRING,
            Type::STRING,
            Type::STRING,
            Type::STRING,
        ];
    }
}

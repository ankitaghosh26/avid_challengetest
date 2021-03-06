<?php

namespace Avid\CandidateChallenge\Repository;

use Avid\CandidateChallenge\Model\Address;
use Avid\CandidateChallenge\Model\Email;
use Avid\CandidateChallenge\Model\Height;
use Avid\CandidateChallenge\Model\Member;
use Avid\CandidateChallenge\Model\Weight;
use Doctrine\DBAL\Types\Type;

use Doctrine\DBAL\Driver\Statement;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Connection;

//use Avid\CandidateChallenge\Repository\MemberRepository;
//use Avid\CandidateChallenge\Repository\Repository;
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
        return 0;
    }

    /**
     * @param Member $member
     *
     * @return int
     */
    public function remove($member)
    {
        return 0;
    }

    /**
     * @param string $username
     *
     * @return Member|null
     */
    public function findByUsername($username)
    {
        return null;
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
        /*echo $keyword;
		$wherearray = array('username'=>$keyword);
		$keyword_array['username']=$keyword;
		$qb = $this->getBaseQuery();
		
		$qb->where("`username`='".$keyword."'");
		echo $qb;
		$rows_inserted = $qb->execute();
		//$connection_local= $this->getConnection();
		//$rows_inserted= $connection_local->fetchAll($qb, $keyword_array);
		echo "<pre>";
		print_r($rows_inserted);
		echo "</pre>";
		return $rows_inserted;*/
		return [];
    }

    /**
     * @param string $keyword
     *
     * @return int
     */
    public function getSearchCount($keyword)
    {
        return 0;
    }

    /**
     * @return int
     */
    public function count()
    {
        return 0;
    }

    /**
     * @param int $first
     * @param int $max
     *
     * @return object
     */
    public function findAll($first = 0, $max = null)
    {
	  $qb = $this->getBaseQuery();
	  $resultarray = $qb->execute();
	  /*echo "<pre>";
	  print_r($resultarray);
	  echo "</pre>";*/
	  return $resultarray;
	  //return [];
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

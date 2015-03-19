<?php

namespace Avid\CandidateChallenge\Model;

/**
 * @covers \Avid\CandidateChallenge\Model\Member
 *
 * @uses \Avid\CandidateChallenge\Model\Address
 * @uses \Avid\CandidateChallenge\Model\Height
 * @uses \Avid\CandidateChallenge\Model\Weight
 * @uses \Avid\CandidateChallenge\Model\Email
 *
 * @author Kevin Archer <kevin.archer@avidlifemedia.com>
 */
final class MemberTest extends \PHPUnit_Framework_TestCase
{
    private $SUT;

    protected function setUp()
    {
        parent::setUp();

       // $this->SUT = new Member();
    }
	 /**
     * @test
     */
	 public function it_should_get_username_and_match_it()
    {
        $expectedMember = new Member(
            'kovacek.keara',
            'et',
            new Address('Canada', 'Ontario', 'Hamilton', 'H4Y 5E1'),
            new \DateTime('1993-04-11'),
            'Undecided',
            new Height('4\' 5"'),
            new Weight('150 lbs'),
            'Slim',
            'Other',
            new Email('kovacek.keara@email.com')
        );

        $this->assertEquals($expectedMember->getUsername(), 'kovacek.keara');
    }
	
	/**
     * @test
     */
	public function it_should_get_userbodytype()
    {
        $expectedMember = new Member(
            'kovacek.keara',
            'et',
            new Address('Canada', 'Ontario', 'Hamilton', 'H4Y 5E1'),
            new \DateTime('1993-04-11'),
            'Undecided',
            new Height('4\' 5"'),
            new Weight('150 lbs'),
            'Slim',
            'Other',
            new Email('kovacek.keara@email.com')
        );

        $this->assertEquals($expectedMember->getBodyType(), 'Slim');
    }
	
	/**
     * @test
     */
	public function it_should_get_userdateofbirth()
    {
        $expectedMember = new Member(
            'kovacek.keara',
            'et',
            new Address('Canada', 'Ontario', 'Hamilton', 'H4Y 5E1'),
            new \DateTime('1993-04-11'),
            'Undecided',
            new Height('4\' 5"'),
            new Weight('150 lbs'),
            'Slim',
            'Other',
            new Email('kovacek.keara@email.com')
        );

        $this->assertEquals($expectedMember->getDateOfBirth(), new \DateTime('1993-04-11'));
    }
	
	/**
     * @test
     */
	public function it_should_get_useraddress()
    {
        $expectedMember = new Member(
            'kovacek.keara',
            'et',
            new Address('Canada', 'Ontario', 'Hamilton', 'H4Y 5E1'),
            new \DateTime('1993-04-11'),
            'Undecided',
            new Height('4\' 5"'),
            new Weight('150 lbs'),
            'Slim',
            'Other',
            new Email('kovacek.keara@email.com')
        );

        $this->assertEquals($expectedMember->getAddress(), new Address('Canada', 'Ontario', 'Hamilton', 'H4Y 5E1'));
    }
	
	/**
     * @test
     */
	public function it_should_get_useremail()
    {
        $expectedMember = new Member(
            'kovacek.keara',
            'et',
            new Address('Canada', 'Ontario', 'Hamilton', 'H4Y 5E1'),
            new \DateTime('1993-04-11'),
            'Undecided',
            new Height('4\' 5"'),
            new Weight('150 lbs'),
            'Slim',
            'Other',
            new Email('kovacek.keara@email.com')
        );

        $this->assertEquals($expectedMember->getEmail(), new Email('kovacek.keara@email.com'));
    }
	
	/**
     * @test
     */
	public function it_should_get_userethnicity()
    {
        $expectedMember = new Member(
            'kovacek.keara',
            'et',
            new Address('Canada', 'Ontario', 'Hamilton', 'H4Y 5E1'),
            new \DateTime('1993-04-11'),
            'Undecided',
            new Height('4\' 5"'),
            new Weight('150 lbs'),
            'Slim',
            'Other',
            new Email('kovacek.keara@email.com')
        );

        $this->assertEquals($expectedMember->getEthnicity(), 'Other');
    }
	
	/**
     * @test
     */
	public function it_should_get_userheight()
    {
        $expectedMember = new Member(
            'kovacek.keara',
            'et',
            new Address('Canada', 'Ontario', 'Hamilton', 'H4Y 5E1'),
            new \DateTime('1993-04-11'),
            'Undecided',
            new Height('4\' 5"'),
            new Weight('150 lbs'),
            'Slim',
            'Other',
            new Email('kovacek.keara@email.com')
        );

        $this->assertEquals($expectedMember->getHeight(), new Height('4\' 5"'));
    }
	
	/**
     * @test
     */
	public function it_should_get_userlimit()
    {
        $expectedMember = new Member(
            'kovacek.keara',
            'et',
            new Address('Canada', 'Ontario', 'Hamilton', 'H4Y 5E1'),
            new \DateTime('1993-04-11'),
            'Undecided',
            new Height('4\' 5"'),
            new Weight('150 lbs'),
            'Slim',
            'Other',
            new Email('kovacek.keara@email.com')
        );

        $this->assertEquals($expectedMember->getLimits(), 'Undecided');
    }
	
	
	/**
     * @test
     */
	public function it_should_get_userpassword()
    {
        $expectedMember = new Member(
            'kovacek.keara',
            'et',
            new Address('Canada', 'Ontario', 'Hamilton', 'H4Y 5E1'),
            new \DateTime('1993-04-11'),
            'Undecided',
            new Height('4\' 5"'),
            new Weight('150 lbs'),
            'Slim',
            'Other',
            new Email('kovacek.keara@email.com')
        );

        $this->assertEquals($expectedMember->getPassword(), 'et');
    }
	
	
	/**
     * @test
     */
	public function it_should_get_userweight()
    {
        $expectedMember = new Member(
            'kovacek.keara',
            'et',
            new Address('Canada', 'Ontario', 'Hamilton', 'H4Y 5E1'),
            new \DateTime('1993-04-11'),
            'Undecided',
            new Height('4\' 5"'),
            new Weight('150 lbs'),
            'Slim',
            'Other',
            new Email('kovacek.keara@email.com')
        );

        $this->assertEquals($expectedMember->getWeight(), new Weight('150 lbs'));
    }
	
}

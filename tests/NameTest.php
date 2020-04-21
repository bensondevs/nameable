<?php

namespace Watson\Nameable\Tests;

use ArgumentCountError;
use Watson\Nameable\Name;

class NameTest extends TestCase
{
    public function setUp(): void
    {
        $this->first = new Name('Dwight');
        $this->name = new Name('Dwight', 'Watson');
    }

    /** @test */
    public function it_can_be_created_with_full_name()
    {
        $name = Name::from('Dwight Conrad Watson');

        $this->assertEquals('Dwight', $name->first);
        $this->assertEquals('Conrad Watson', $name->last);
    }

    /** @test */
    public function it_can_be_created_with_first_name()
    {
        $name = Name::from('Dwight');

        $this->assertEquals('Dwight', $name->first);
        $this->assertNull($name->last);
    }

    /** @test */
    public function it_trims_additional_spacing_when_creating_full_name()
    {
        $name = Name::from('   Dwight   Conrad  Watson  ');

        $this->assertEquals('Dwight', $name->first);
        $this->assertEquals('Conrad Watson', $name->last);
    }

    /** @test */
    public function it_gets_first_and_last()
    {
        $this->assertEquals('Dwight', $this->name->first);
        $this->assertEquals('Watson', $this->name->last);

        $this->assertEquals('Dwight', $this->first->first);
        $this->assertNull($this->first->last);
    }

    /** @test */
    public function it_gets_full_name()
    {
        $this->assertEquals('Dwight Watson', $this->name->full);
        $this->assertEquals('Dwight Watson', (string) $this->name);

        $this->assertEquals('Dwight', $this->first->full);
        $this->assertEquals('Dwight', (string) $this->first);
    }

    /** @test */
    public function it_gets_familiar()
    {
        $this->assertEquals('Dwight W.', $this->name->familiar);

        $this->assertEquals('Dwight', $this->first->familiar);
    }

    /** @test */
    public function it_gets_abbreviated() {
        $this->assertEquals('D. Watson', $this->name->abbreviated);

        $this->assertEquals('Dwight', $this->first->abbreviated);
    }

    /** @test */
    public function it_gets_sorted() {
        $this->assertEquals('Watson, Dwight', $this->name->sorted);

        $this->assertEquals('Dwight', $this->first->sorted);
    }

    /** @test */
    public function it_gets_full_possessives()
    {
        $this->assertEquals("Dwight Watson's", $this->name->full_possessive);

        $this->assertEquals("Dwight's", $this->first->full_possessive);

        $this->assertEquals("Foo Bars'", (new Name('Foo', 'Bars'))->full_possessive);
    }

    /** @test */
    public function it_gets_first_possessives()
    {
        $this->assertEquals("Dwight's", $this->name->first_possessive);
    }

    /** @test */
    public function it_gets_last_possessives()
    {
        $this->assertEquals("Watson's", $this->name->last_possessive);
    }

    /** @test */
    public function it_gets_sorted_possessives()
    {
        $this->assertEquals("Watson, Dwight's", $this->name->sorted_possessive);
    }

    /** @test */
    public function it_gets_initials_possessives()
    {
        $this->assertEquals("DW's", $this->name->initials_possessive);
    }

    /** @test */
    public function it_gets_abbreviated_possessives()
    {
        $this->assertEquals("D. Watson's", $this->name->abbreviated_possessive);
    }

    /** @test */
    public function it_gets_initials()
    {
        $name = Name::from('Dwight Conrad Watson');

        $this->assertEquals('DCW', $name->initials);
    }

    /** @test */
    public function it_gets_initials_with_spaces()
    {
        $name = Name::from('   Dwight   Conrad  Watson  ');

        $this->assertEquals('DCW', $name->initials);
    }

    /** @test */
    public function it_gets_initials_with_first_name()
    {
        $name = Name::from('Dwight');

        $this->assertEquals('D', $name->initials);
    }

    /** @test */
    public function it_gets_initials_without_parenthesis()
    {
        $name = Name::from('Dwight Conrad Watson (Roomies)');

        $this->assertEquals('DCW', $name->initials);
    }

    /** @test */
    public function it_gets_initials_without_special_characters()
    {
        $name = Name::from('Dwight Conrad Watson !');

        $this->assertEquals('DCW', $name->initials);
    }
}

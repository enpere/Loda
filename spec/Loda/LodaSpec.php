<?php

namespace spec\Loda;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LodaSpec extends ObjectBehavior
{

	function let()
	{
    	$this->beConstructedWith(["jens", "nicole", "joakim"]);
	}

    function it_optional_to_instatiate_with_existing_array()
    {
    	$this->shouldHaveCount(0);
    } 

    function it_can_be_instatiated_with_an_existing_array()
    {
    	$this->shouldHaveCount(3);
    }

    function it_should_return_array_of_names()
    {
    	$this->shouldHaveCount(3);
    	$this->all()->shouldReturn(["jens", "nicole", "joakim"]);
    }

    function it_should_return_and_remove_the_wanted_field_in_collection()
    {
    	$this->shift()->shouldReturn("jens");
    	$this->all()->shouldReturn(["nicole", "joakim"]);
    }
}

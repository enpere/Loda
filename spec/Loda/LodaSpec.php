<?php

namespace spec\Loda;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LodaSpec extends ObjectBehavior
{

	function let()
	{
    	$this->beConstructedWith(["jens", "nicole", "siblings" => ["joakim"]]);
	}

//    function it_optional_to_instatiate_with_existing_array()
//    {
//    	$this->shouldHaveCount(0);
//    }

    function it_can_be_instatiated_with_an_existing_array()
    {
    	$this->shouldHaveCount(3);
    }

    function it_should_return_array_of_names()
    {
    	$this->shouldHaveCount(3);
    	$this->all()->shouldReturn(["jens", "nicole", "siblings" => ["joakim"]]);
    }

    function it_should_return_and_remove_the_wanted_field_in_collection()
    {
    	$this->shift()->shouldReturn("jens");
    	$this->all()->shouldReturn(["nicole", "siblings" => ["joakim"]]);
    }

    function it_should_pick_by_key_and_return_value_if_exists_or_null_if_not_exists()
    {
        $this->pick("siblings")->shouldReturn(["joakim"]);
        $this->pick("keythatdoesntexists")->shouldReturn(null);
    }

    function it_should_return_value_by_key_and_then_remove_value_from_collection()
    {
    	$this->forget("siblings")->shouldReturn(["joakim"]);
    }

    function it_should_return_collection_in_json_format()
    {
    	$this->toJson()->shouldReturn('{"0":"jens","1":"nicole","siblings":["joakim"]}');
    }

}

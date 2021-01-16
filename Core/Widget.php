<?php

abstract class Widget
{
	public DateTime $time_stamp;
	public abstract function display(): void;
}

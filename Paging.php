<?php
class Paging
{
	public
		$DATA			= NULL,
		$LIMIT			= 50,
		$DOTS			= true,
		$ARROWS			= true,
		$WLIMIT			= 2,
		$CURRENT		= 1,
		$SELECT			= true,
		$NAME			= 'pn',
		$PC,
		$LINK;
	//----------------------------------------------------------------//
	public function __construct()
	{
		$this->LINK = (($_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		
		if($_GET[$this->NAME])
			$this->CURRENT = $_GET[$this->NAME];
	}
	//----------------------------------------------------------------//
	private function currLinker($Value,$JS = false)
	{
		if(isset($_GET[$this->NAME]))
			return str_replace($this->NAME .'='. $this->CURRENT,$this->NAME .'='. (($JS == false) ? $Value : '{page}'),$this->LINK);
		else
			return $this->LINK . ((sizeof($_GET)) ? '&'. $this->NAME .'='. $Value : '?'. $this->NAME .'='. (($JS == false) ? $Value : '{page}'));
	}
	//----------------------------------------------------------------//
	public function limited()
	{
		return ' limit '. (($this->CURRENT > 1 && ceil($this->DATA / $this->LIMIT) > 1) ? (($this->CURRENT - 1) * $this->LIMIT .','. $this->LIMIT) : $this->LIMIT);
	}
	//----------------------------------------------------------------//
	public function template($RET = false)
	{
		if($this->DATA != NULL)
		{
			$Start	= 1;
			$this->PC = ceil($this->DATA / $this->LIMIT);
			if($this->PC > $this->WLIMIT)
			{
				if($this->CURRENT > $this->WLIMIT)
				{
					$End		= ($this->CURRENT + $this->WLIMIT <= $this->PC) ? $this->CURRENT + $this->WLIMIT : $this->PC;
					$Start	= (($this->CURRENT == $this->PC) ? (($this->PC - ($this->WLIMIT * 2) < 1) ? 1 : $this->PC - ($this->WLIMIT * 2)) : $this->CURRENT - $this->WLIMIT);
				}
				else
				{
					$Start		= 1;
					if($this->CURRENT == 1)
						$End		= ($this->WLIMIT * 2) - 1;
					elseif($this->CURRENT > 1 && ($this->CURRENT + $this->WLIMIT) <= $this->PC)
						$End		=  $this->CURRENT + $this->WLIMIT;
					elseif($this->CURRENT > 1 && ($this->CURRENT + $this->WLIMIT) <= $this->PC)
						$End		=  $this->PC;
					else
						$End		=  $this->CURRENT + $this->WLIMIT - 1;
				}
				
				if($End < $this->PC && $this->CURRENT <= ($this->WLIMIT * 2) && $this->DOTS = true)
					$eDots = true;
					
				if($this->CURRENT > $this->WLIMIT + 1 && $this->PC > ($this->WLIMIT * 2) && $this->DOTS = true)
					$sDots = true;
			}
			else
				$End = $this->PC;
			
			$tDATA = '<div class="pagination pagination-right"><ul>';
				
			if($sDots == true)
				$tDATA .= '<li><a href="'. $this->currLinker($this->CURRENT - 1) .'">&laquo;</a></li><li><a href="'. $this->currLinker(1) .'">1</a></li><li class="dots"><span>...</span></li>';
				
			if($Start < $End)
			{
				for($i=$Start;$i<=$End;++$i)
					$tDATA .= '<li'. (($i == $this->CURRENT) ? ' class="disabled active"' : '') .'><a href="'. $this->currLinker($i) .'">'. $i  .'</a></li>';
			}
			
			if($eDots == true)
				$tDATA .= '<li class="dots"><span>...</span></li><li><a href="'. $this->currLinker($this->PC) .'">'. $this->PC .'</a></li><li><a href="'. $this->currLinker($this->CURRENT + 1) .'">&raquo;</a></li>';
				
			if($this->SELECT == true && $this->CURRENT > $this->WLIMIT * 2 && $this->PC > ($this->WLIMIT * 2))
			{
				$tDATA .= '<li class="dots"><span><select onchange="location.href=\''. $this->currLinker(true,true) .'\'.replace(\'{page}\',this.value);">';
				for($i=1;$i<=$this->PC;++$i)
					$tDATA .= '<option'. (($i == $this->CURRENT) ? ' selected="selected"' : '') .'>'. $i .'</option>';
				$tDATA .= '</select></span></li>';
			}
			
			$tDATA .= '</ul></div>';
			
			if($RET == false)
				echo $tDATA;
			else
				return $tDATA;
		}
	}
	//----------------------------------------------------------------//
}
?>

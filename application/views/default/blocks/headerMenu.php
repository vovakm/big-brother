<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*
 * @copyright	Copyright 2011-2012, Vladimir Kopot, vovakm@mail.ua
 * @license 	Apache/BSD-style open source license
 */
?>


<div class="codropsmenu1" id="menu">
    <ul>
		<?php if (isset($access_to_database) && ($access_to_database == '2222222222222222')): ?>
			<li>
				<a href="<?php echo base_url(); ?>acounts/" class="first" title="<?php echo printMessage('menu-item-full-manage-user'); ?>">
					<span><span class="blueText"><?php echo printMessage('menu-item-short-manage-user'); ?></span></span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url(); ?>statistic/" title="<?php echo printMessage('menu-item-full-statistic'); ?>">
					<span><span class="blueText"><?php echo printMessage('menu-item-short-statistic'); ?></span></span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url(); ?>advanced/" title="<?php echo printMessage('menu-item-full-advanced'); ?>">
					<span><span class="blueText"><?php echo printMessage('menu-item-short-advanced'); ?></span></span>
				</a>
			</li>
			<?php
		endif;

		if (isset($access_to_database) && ($access_to_database != '2222222222222222'))
			$first = 'class="first"';
		?>

        <li>
			<a href="<?php echo base_url(); ?>bday/" <?php if (isset($first))
			echo $first; ?> title="<?php echo printMessage('menu-item-full-bday'); ?>">
				<span><span><?php echo printMessage('menu-item-short-bday'); ?></span></span>
			</a>
		</li>
        <li>
			<a href="<?php echo base_url(); ?>userinfo/" title="<?php echo printMessage('menu-item-full-userinfo'); ?>"> 
				<span><span><?php echo printMessage('menu-item-short-userinfo'); ?></span></span>
			</a>
		</li>
        <li>
			<a href="<?php echo base_url(); ?>editpass/" title="<?php echo printMessage('menu-item-full-editpass'); ?>">
				<span><span><?php echo printMessage('menu-item-short-editpass'); ?></span></span>
			</a>
		</li>
        <li>
			<a href="<?php echo base_url(); ?>about/" class="last" title="<?php echo printMessage('menu-item-full-about'); ?>">
				<span><span><?php echo printMessage('menu-item-short-about'); ?></span></span>
			</a>
		</li>

    </ul>
</div>
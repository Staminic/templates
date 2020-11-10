<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

$this->form->reset(true);
$this->form->loadFile(dirname(__FILE__) . '/' . 'login.xml');

?>

<div class="inner">
	<h2 class="text-center">Connexion</h2>
	<div class="card col-lg-6 offset-lg-3">
		<div class="card-body">
			<div class="login<?php echo $this->pageclass_sfx; ?>">
				<?php if ($this->params->get('show_page_heading')) : ?>
					<div class="page-header full-width">
						<div class="container">
							<h1>
								<?php echo $this->escape($this->params->get('page_heading')); ?>
							</h1>
						</div>
					</div>
				<?php endif; ?>
				<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
					<div class="login-description">
				<?php endif; ?>
				<?php if ($this->params->get('logindescription_show') == 1) : ?>
					<?php echo $this->params->get('login_description'); ?>
				<?php endif; ?>
				<?php if ($this->params->get('login_image') != '') : ?>
					<img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo JText::_('COM_USERS_LOGIN_IMAGE_ALT'); ?>" />
				<?php endif; ?>
				<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
					</div>
				<?php endif; ?>
				<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="form-validate form-horizontal well">
					<fieldset>
						<?php echo $this->form->renderFieldset('credentials'); ?>
						<?php if ($this->tfa) : ?>
							<?php echo $this->form->renderField('secretkey'); ?>
						<?php endif; ?>
						<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
							<div class="form-group form-check">
								<input id="remember" type="checkbox" name="remember" class="inputbox form-check-input" value="yes" />
								<label for="remember" class="form-check-label">
									<?php echo JText::_('COM_USERS_LOGIN_REMEMBER_ME'); ?>
								</label>
							</div>
						<?php endif; ?>
						<div class="control-group">
							<button type="submit" class="btn btn-primary">
								<?php echo JText::_('JLOGIN'); ?>
							</button>
						</div>
						<?php $return = $this->form->getValue('return', '', $this->params->get('login_redirect_url', $this->params->get('login_redirect_menuitem'))); ?>
						<input type="hidden" name="return" value="<?php echo base64_encode($return); ?>" />
						<?php echo JHtml::_('form.token'); ?>
					</fieldset>
				</form>
			</div>

			<div class="mt-3">
				<ul class="nav flex-column">
					<li class="nav-item">
						<a class="nav-link pl-0" href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
							<?php echo JText::_('COM_USERS_LOGIN_RESET'); ?>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link pl-0" href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
							<?php echo JText::_('COM_USERS_LOGIN_REMIND'); ?>
						</a>
					</li>
					<?php $usersConfig = JComponentHelper::getParams('com_users'); ?>
					<?php if ($usersConfig->get('allowUserRegistration')) : ?>
						<li class="nav-item">
							<a class="nav-link pl-0" href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
								<?php echo JText::_('COM_USERS_LOGIN_REGISTER'); ?>
							</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
</div>

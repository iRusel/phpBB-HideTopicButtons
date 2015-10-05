<?php
/**
*
* @package Hide Topic Buttons Extension
* @copyright (c) 2015 iRusel
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace iRusel\HideTopicButtons\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\twig\twig */
	protected $template;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\user */
	protected $user;

	/** @var ContainerInterface */
	protected $container;

	/** @var string Custom form action */
	protected $u_action;

	/**
	* Constructor for listener
	*
	* @param \phpbb\config\config				$config		Config object
	* @param \phpbb\template\twig\twig			$template	Template object
	* @param \phpbb\auth\auth 					$auth
	* @param \phpbb\user						$user		User object
	* @param \phpbb\db\driver\driver_interface	$db
	* @param ContainerInterface					$container	Service container interface
	* @access public
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\template\twig\twig $template, \phpbb\auth\auth $auth, \phpbb\user $user, $container)
	{
		$this->config		= $config;
		$this->template		= $template;
		$this->auth			= $auth;
		$this->user			= $user;		
		$this->container	= $container;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.viewtopic_modify_page_title'	=>	'viewtopic_hide_buttons',
		);
	}

	/**
	* Process the Hide Topic Buttons
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function viewtopic_hide_buttons()
	{		
		if ($this->user->data['user_id'] == ANONYMOUS)
		{
			// Set output vars for display in the template
			$this->template->assign_vars(array(
				'S_DISPLAY_REPLY_INFO'	=> false,			
				'S_QUICK_REPLY'			=> false,
				'S_DISPLAY_SEARCHBOX'	=> false,				
			));
		}	
	}
}
		
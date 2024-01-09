import {registerBlockType} from '@wordpress/blocks';
import icons from '../../icons.js';
import './main.scss';
import edit from './edit.js';
import save from './save.js';


registerBlockType('bwd-plus/team-member', {
  icon: icons.primary,
  edit,
  save
});
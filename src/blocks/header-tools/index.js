import {registerBlockType} from '@wordpress/blocks';
import {
  useBlockProps,
  InspectorControls
} from '@wordpress/block-editor';
import {
  PanelBody,
  SelectControl,
  CheckboxControl
} from '@wordpress/components';
import {__} from '@wordpress/i18n';
import icons from '../../icons';
import './main.scss';

registerBlockType('bwd-plus/header-tools', {
  icon: icons.primary,

  edit ({attributes, setAttributes}) {
    const {showAuth} = attributes;
    const blockProps = useBlockProps();

    return (
      <>
        <InspectorControls>
          <PanelBody title={__('Header Tools Settings', 'bwd-plus')}>
            <SelectControl
              label={__('Show Login / Register', 'bwd-plus')}
              value={showAuth}
              options={[
                {label: __('Yes', 'bwd-plus'), value: true},
                {label: __('No', 'bwd-plus'), value: false}
              ]}
              onChange={showAuth => setAttributes({ showAuth: (showAuth === 'true') })}
            />
            <CheckboxControl
              label={__('Show Login / Register', 'bwd-plus')}
              help={
                showAuth
                ? __('Showing Login / Register', 'bwd-plus')
                :
                __('Login / Register Hidden', 'bwd-plus')
              }
              checked={showAuth}
              onChange={showAuth => setAttributes({ showAuth })}
            />
          </PanelBody>
        </InspectorControls>
        <div { ...blockProps }>
          {
            showAuth &&
            <a className="signin-link open-modal" href="#">
              <div className="signin-icon">
                <i className="bi bi-person-circle"></i>
              </div>
              <div className="signin-text">
                <small>Hello, Sign in</small>
                My Account
              </div>
            </a>
          }
        </div>
      </>
    );
  }
});
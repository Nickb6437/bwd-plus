import {registerBlockType} from '@wordpress/blocks';
import {
  useBlockProps,
  InspectorControls
} from '@wordpress/block-editor';
import {
  PanelBody,
  ToggleControl
} from '@wordpress/components';
import {__} from '@wordpress/i18n';
import icons from '../../icons';
import './main.scss';

registerBlockType('bwd-plus/auth-modal', {
  icon: icons.primary,

  edit ({attributes, setAttributes}) {
    const {showRegister} = attributes;
    const blockProps = useBlockProps();

    return (
      <>
        <InspectorControls>
          <PanelBody title={ __('General', 'bwd-plus') }>
            <ToggleControl 
              label={ __('Show Register Modal', 'bwd-plus') }
              help={ 
                showRegister ? 
                __('Showing the registeration form', 'bwd-plus') 
                :
                __('Hiding the registeration form', 'bwd-plus')
              }
              checked={ showRegister }
              onChange={ showRegister => setAttributes({ showRegister }) }
            />
          </PanelBody>
        </InspectorControls>
        <div { ...blockProps }>
          {__('This block is not previewable from the editor. View your site for a live demo.', 'bwd-plus')}
        </div>
      </>
    )
  }
});
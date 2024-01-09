import {registerBlockType} from '@wordpress/blocks';
import {
  useBlockProps,
  RichText,
  InspectorControls
} from '@wordpress/block-editor';
import {
  PanelBody, 
  ToggleControl 
} from '@wordpress/components';
import {__} from '@wordpress/i18n';
import icons from '../../icons';
import './main.scss';

registerBlockType('bwd-plus/page-header', {
  icon: icons.primary,

  edit: ({attributes, setAttributes}) => {
    const blockProps = useBlockProps();
    const {
      content,
      showCategory
    } = attributes;

    return (
      <>
        <InspectorControls>
          <PanelBody title={__('General', 'bwd-plus')}>
            <ToggleControl
              label={__('Show Category', 'bwd-plus')}
              checked={showCategory}
              onChange={(showCategory) => setAttributes({showCategory})}
              help={
                showCategory ? 
                __('Showing category', 'bwd-plus')
                :
                __('Custom heading', 'bwd-plus')}
            />
          </PanelBody>
        </InspectorControls>
        <div {...blockProps}>
          <div className="inner-page-header">
            {
              showCategory ? 
                <h1>{__('Category: Some Category', 'bwd-plus')}</h1>
              :
              <RichText
                tagName='h1'
                placeholder={__('Heading', 'bwd-plus')}
                value={__(content, 'bwd-plus')}
                onChange={(content) => setAttributes({content})}
              />
            }
          </div>
        </div>
      </>
    );
  },
});

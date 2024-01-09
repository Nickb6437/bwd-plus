import {registerBlockType} from '@wordpress/blocks';
import {
  useBlockProps,
  InspectorControls,
  InnerBlocks
} from '@wordpress/block-editor';
import {
  PanelBody, 
  RangeControl, 
  SelectControl
} from '@wordpress/components'
import {__} from '@wordpress/i18n';
import icons from '../../icons';
import './main.scss';

registerBlockType('bwd-plus/team-members-group', {
  icon: icons.primary,

  edit({ attributes, setAttributes }) {
    const { columns, imageShape } = attributes;
    const blockProps = useBlockProps({
      className: `cols-${columns}`
    });
   
    return (
      <>
        <InspectorControls>
          <PanelBody title={__('Settings', 'bwd-plus')}>
            <RangeControl 
              label={__('Columns', 'bwd-plus')}
              onChange={columns => setAttributes({columns})}
              value={columns}
              min={2}
              max={4}
            />
            <SelectControl 
              label={__('Image Shape', 'bwd-plus')}
              value={ imageShape }
              options={[
                  { label: __('Hexagon', 'bwd-plus'), value: 'hexagon' },
                  { label: __('Rabbet', 'bwd-plus'), value: 'rabbet' },
                  { label: __('Pentagon', 'bwd-plus'), value: 'pentagon' },
              ]}
              onChange={imageShape => setAttributes({ imageShape })}
            />
          </PanelBody>
        </InspectorControls>
        <div {...blockProps}>
          <InnerBlocks 
            orientation="horizontal"
            allowedBlocks={['bwd-plus/team-member']}
            template={[
              ['bwd-plus/team-member', {
                name: 'John Doe',
                title: 'CEO',
                bio: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
              }],
              ['bwd-plus/team-member'],
              ['bwd-plus/team-member'],
            ]}
            // templateLock='insert'
          />
        </div>
      </>
    );
  },
  save({ attributes }) {
    const {columns} = attributes;
    const blockProps = useBlockProps.save({
      className: `cols-${columns}`
    });

    return (
      <div {...blockProps}>
        <InnerBlocks.Content />
      </div>
    )
  }
});

import {registerPlugin} from '@wordpress/plugins';
import {PluginSidebar} from '@wordpress/edit-post';
import {__} from '@wordpress/i18n';
import {
  useSelect,
  useDispatch
} from '@wordpress/data';
import {
  PanelBody, 
  TextControl, 
  TextareaControl, 
  ToggleControl
} from '@wordpress/components';
import {
  MediaUpload,
  MediaUploadCheck
} from '@wordpress/block-editor';

registerPlugin('bwd-plus-sidebar', {
  render() {
    const {
      og_title,
      og_description,
      og_image,
      og_override_image
    } = useSelect((select) => {
      return select('core/editor').getEditedPostAttribute('meta');
    });

    const {editPost} = useDispatch('core/editor');

    return (
      <PluginSidebar
        name="bwd-plus-sidebar"
        icon="share"
        title={__('BWD Plus Sidebar', 'bwd-plus')}
      >
        <PanelBody title={__("Opengraph Options", "bwd-plus")}>
          <TextControl 
            label={__("Title", "bwd-plus")}
            value={og_title}
            onChange={(og_title) => 
              editPost({
                meta: {
                  og_title
                }
              })
            }
          />
          <TextareaControl 
            label={__("Description", "bwd-plus")}
            value={og_description}
            onChange={(og_description) => {
              editPost({
                meta: {
                  og_description
                }
              })
            }}
          />
          <ToggleControl 
            label={__("Override Featured Image", "bwd-plus")}
            checked={og_override_image}
            help={__(
              "By default, the featured image will be used as the image. Check this option to use a different image.",
              "bwd-plus"
            )}
            onChange={og_override_image => {
              editPost({
                meta: {
                  og_override_image
                }
              })
            }}
          />
          {og_override_image && (
            <>
              <img
                src={og_image}
              />
              <MediaUploadCheck>
                <MediaUpload 
                  accept={["image"]}
                  render={({open}) => {
                    return (
                      <button
                        className='components-button is-primary'
                        onClick={open}
                      >
                        {__("Upload/Select Image", "bwd-plus")}
                      </button>
                    )
                  }}
                  onSelect={(image) => {
                    editPost({
                      meta: {
                        og_image: image.sizes.opengraph.url
                      }
                    })
                  }}
                />
              </MediaUploadCheck>
            </>
          )}
        </PanelBody>
      </PluginSidebar>
    );
  }
}); // adds a sidebar to the block editor after page load

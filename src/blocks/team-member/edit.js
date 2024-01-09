import { 
  useBlockProps, 
  InspectorControls, 
  RichText,
  MediaPlaceholder,
  BlockControls,
  MediaReplaceFlow
} from '@wordpress/block-editor';
import {__} from '@wordpress/i18n';
import { 
  PanelBody, 
  TextareaControl,
  Spinner,
  ToolbarButton,
  Tooltip,
  Icon,
  TextControl,
  Button
} from '@wordpress/components';
import {
  isBlobURL,
  revokeBlobURL
} from '@wordpress/blob';
import {useState} from '@wordpress/element';

export default function ({ attributes, setAttributes, context, isSelected }) {
  const { 
    name, title, bio, imgID, imgAlt, imgURL, socialHandles
  } = attributes;
  const blockProps = useBlockProps();

  const [imgPreview, setImgPreview] = useState(imgURL);

  const selectImg = img => {
    let newImgURL = null
    if (isBlobURL(img.url)) {
      newImgURL = img.url;
    } else {
      newImgURL = img.sizes ? img.sizes.teamMember.url : 
      img.media_details.sizes.teamMember.source_url;

      setAttributes({
        imgID: img.id,
        imgAlt: img.alt,
        imgURL: newImgURL
      })
      revokeBlobURL(imgPreview);
    }
    setImgPreview(newImgURL);
  }

  const selectImgURL = (url) => {
    setAttributes({
      imgID: null,
      imgAlt: null,
      imgURL: url,
    });

    setImgPreview(url);
  };

  const imageClass = `wp-image-${imgID} img-${context['bwd-plus/image-shape']}`;

  const [activeSocialLink, setActiveSocialLink] = useState(null);

  setAttributes({
    imageShape: context['bwd-plus/image-shape']
  });

  return (
    <>
        { imgPreview &&
          <BlockControls group="inline">
            <MediaReplaceFlow 
              name={__('Replace Image', 'bwd-plus')}
              mediaId={imgID}
              mediaURL={imgURL}
              accept={'image/*'}
              allowedTypes={['image']}
              onError={err => console.error(err)}
              onSelect={selectImg}
              onSelectURL={selectImgURL}
            />
            <ToolbarButton 
              onClick={() => { 
                setAttributes ({
                  imgID: 0,
                  imgAlt: "",
                  imgURL: ""
                }); 
                setImgPreview("");
              }}
            >
              {__('Remove Image', 'bwd-plus')}
            </ToolbarButton>
          </BlockControls>
        }
      <InspectorControls>
        <PanelBody title={__('Settings', 'bwd-plus')}>
          { imgPreview && !isBlobURL(imgPreview) && (
            <TextareaControl 
              label={__('Alt Attribute', 'bwd-plus')}
              value={imgAlt}
              onChange={imgAlt => setAttributes({imgAlt})}
              help={__(
                'Description of your image for screen readers.',
                'bwd-plus'
              )}
            />
          )}
        </PanelBody>
      </InspectorControls>
      <div {...blockProps}>
        <div className="author-meta">
          {
            imgPreview &&
            <img 
              src={imgPreview} 
              alt={imgAlt}
              className={imageClass}
            />
          }
          { 
            isBlobURL(imgPreview) && 
            <Spinner />
          }
          <MediaPlaceholder
            allowedTypes={['image']}
            accept={'image/*'}
            icon="admin-users"
            onSelect={selectImg}
            onError={err => console.error(err)}
            disableMediaButtons={imgPreview}
            onSelectURL={selectImgURL}
          />
          <p>
            <RichText 
              placeholder={__('Name', 'bwd-plus')}
              tagName="strong"
              onChange={name => setAttributes({name})}
              value={name}
            />
            <RichText 
              placeholder={__('Title', 'bwd-plus')}
              tagName="span"
              onChange={title => setAttributes({title})}
              value={title}
            />
          </p>
        </div>
        <div className="member-bio">
          <RichText 
            placeholder={__('Member bio', 'bwd-plus')}
            tagName="p"
            onChange={bio => setAttributes({bio})}
            value={bio}
          />
        </div>
        <div className="social-links">
          {
            socialHandles.map((handle, index) => {  
              return (
                <a 
                  href={handle.url} 
                  key={index}
                  onClick={e => {
                    e.preventDefault();
                    setActiveSocialLink(activeSocialLink === index ? null : index)
                  }}
                  className={activeSocialLink === index && isSelected ? "is-active" : ""}
                >
                  <i className={`bi bi-${handle.icon}`}></i>
                </a>
              );
            })
          }
          { isSelected &&
            <Tooltip text={__('Add Social Link', 'bwd-plus')}>
              <a href="#" onClick={e => {
                e.preventDefault();
                setAttributes({
                  socialHandles: [
                    ...socialHandles,
                    {
                      icon: "question",
                      url: ""
                    }
                  ]
                });
                setActiveSocialLink(socialHandles.length);
              }}>
                <Icon icon="plus" />
              </a>
            </Tooltip>
          }
        </div>
        { isSelected && activeSocialLink !== null && (
          <div className="team-member-social-edit-ctr">
            <TextControl
              label={__('URL', 'bwd-plus')}
              value={socialHandles[activeSocialLink].url}
              onChange={url => {
                const tempLink = {...socialHandles[activeSocialLink]};
                const tempSocial = [...socialHandles];
                tempLink.url = url;
                tempSocial[activeSocialLink] = tempLink;
                setAttributes({socialHandles: tempSocial});
              }}
            />
            <TextControl
              label={__('Icon', 'bwd-plus')}
              value={socialHandles[activeSocialLink].icon}
              onChange={icon => {
                const tempLink = {...socialHandles[activeSocialLink]};
                const tempSocial = [...socialHandles];
                tempLink.icon = icon;
                tempSocial[activeSocialLink] = tempLink;
                setAttributes({socialHandles: tempSocial});
              }}
            />
            <Button
              isDestructive
              onClick={() => {
                const tempSocial = [...socialHandles];
                tempSocial.splice(activeSocialLink, 1);
                setAttributes({socialHandles: tempSocial});
                setActiveSocialLink(null);
              }} 
            >
              {__('Remove Link', 'bwd-plus')}
            </Button>
          </div>
        )}
      </div>
    </>
  );
}
import {registerBlockType} from '@wordpress/blocks';
import { 
  useBlockProps, 
  RichText 
} from '@wordpress/block-editor';
import {Spinner} from '@wordpress/components';
import {Rating} from "@mui/material"
import {__} from '@wordpress/i18n';
import {useEntityProp} from '@wordpress/core-data';
import {useSelect} from '@wordpress/data';
import icons from '../../icons.js';
import './main.scss';

registerBlockType('bwd-plus/recipe-summary', {
  icon: icons.primary,
  edit({
    attributes, 
    setAttributes,
    context
  }) {
    const {postId} = context;
    const { 
      prepTime, 
      cookTime, 
      course 
    } = attributes;
    const blockProps = useBlockProps();

    const [termIDs] = useEntityProp(
      'postType','recipe', 'cuisine', postId, 'meta'
    );

    const {
      cuisines, 
      isLoading
    } = useSelect( (select) => {
      const {
        getEntityRecords, 
        isResolving
      } = select('core');

      const taxonomyArgs = [
        'taxonomy', 'cuisine', {
          include: termIDs
        }
      ]

      return {
        cuisines: getEntityRecords(...taxonomyArgs),
        isLoading: isResolving('getEntityRecords', taxonomyArgs)
      };
    }, [termIDs]);

    const {rating} = useSelect(select => {
      const {getCurrentPostAttribute} = select('core/editor')

      return {
        rating: getCurrentPostAttribute('meta').recipe_rating
      }
    });

    return (
      <>
        <div {...blockProps}>
          <i className="bi bi-alarm"></i>
          <div className="recipe-columns-2">
            <div className="recipe-metadata">
              <div className="recipe-title">{__('Prep Time', 'bwd-plus')}</div>
              <div className="recipe-data recipe-prep-time">
                <RichText
                  tagName="span"
                  value={ prepTime } 
                  onChange={ prepTime => setAttributes({ prepTime }) }
                  placeholder={ __('Prep time', 'bwd-plus') }
                />
              </div>
            </div>
            <div className="recipe-metadata">
              <div className="recipe-title">{__('Cook Time', 'bwd-plus')}</div>
              <div className="recipe-data recipe-cook-time">
                <RichText
                  tagName="span"
                  value={ cookTime } 
                  onChange={ cookTime => setAttributes({ cookTime }) }
                  placeholder={ __('Cook time', 'bwd-plus') }
                />
              </div>
            </div>
          </div>
          <div className="recipe-columns-2-alt">
            <div className="recipe-columns-2">
              <div className="recipe-metadata">
                <div className="recipe-title">{__('Course', 'bwd-plus')}</div>
                <div className="recipe-data recipe-course">
                  <RichText
                    tagName="span"
                    value={ course } 
                    onChange={ course => setAttributes({ course }) }
                    placeholder={ __('Course', 'bwd-plus') }
                  />
                </div>
              </div>
              <div className="recipe-metadata">
                <div className="recipe-title">{__('Cuisine', 'bwd-plus')}</div>
                <div className="recipe-data recipe-cuisine">
                  { 
                    isLoading && <Spinner />
                  }
                  {
                    !isLoading && cuisines && cuisines.map((cuisine, index) => {
                      const comma = cuisines[index + 1] ? ', ' : '';
                      return (
                        <>
                          <a href={cuisine.meta.bwd_plus_more_info_url}>
                            {cuisine.name} 
                          </a>{comma}
                        </>
                      )
                    })
                  } 
                </div>
              </div>
              <i className="bi bi-egg-fried"></i>
            </div>
            <div className="recipe-metadata">
              <div className="recipe-title">{__('Rating', 'bwd-plus')}</div>
              <div className="recipe-data">
                <Rating 
                  name='recipe-rating'
                  value={rating} 
                  readOnly
                />
              </div>
              <i className="bi bi-hand-thumbs-up"></i>
            </div>
          </div>
        </div>
      </>
    );
  }
});
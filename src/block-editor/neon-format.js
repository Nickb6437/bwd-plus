import "./neon.scss"
import {registerFormatType, toggleFormat} from "@wordpress/rich-text";
import {RichTextToolbarButton} from "@wordpress/block-editor";
import {__} from "@wordpress/i18n";
import {useSelect} from "@wordpress/data";

registerFormatType("bwd-plus/neon", {
  title: __("Neon", "bwd-plus"),
  tagName: "span",
  className: "neon",
  edit({isActive, value, onChange}) {
    const selectBlock = useSelect( (select) => select("core/block-editor").getSelectedBlock());
    return (
      <>
        { selectBlock?.name === "core/paragraph" && 
          <RichTextToolbarButton 
            title={__("Neon", "bwd-plus")}
            icon="superhero"
            isActive={isActive}
            onClick={() => {
              onChange(
                toggleFormat(value, {
                  type: "bwd-plus/neon"
                })
              );
            }}
          />
        }
      </>
    );
  }
});
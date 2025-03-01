/**
 * External dependencies
*/
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import { Fragment } from '@wordpress/element';
import OGB_Element from '../../components/element';

function ogbInfoBoxSave(props) {
    const {
        attributes,
    } = props;
    const {
        blockId,
        className,
        type,
        text,
        icon,
        link,
        position,
        alignment,
        title,
        description,
        titleSeparator,
        titleTag,
        mediaUrl,
        mediaWidth,
        mediaHeight,
        imgSize,
        linkType,
        primaryBtnText,
        primaryBtnIcon,
        primaryBtnIconPosition,
    } = attributes;

    let htmlAttributes = {
        className: classnames({
            'ogb-info-box-container': true,
            [`ogb-info-box-container-${blockId}`]: true,
            [`ogb-info-box-${position}`]: position,
            [`ogb-info-box-${alignment}`]: alignment,
            [className]: undefined !== className,
        }),
    };

    let wrapperClass = {
        className: classnames({
            'ogb-info-box-wrap': true,
            [className]: undefined !== className,
        }),
    };

    const imgStyle = {
        width: mediaWidth,
        height: mediaHeight,
        src: mediaUrl !== '' ? mediaUrl : 'none',
        className: 'attachment-' + imgSize + ' size-' + imgSize,
    };

    let wrapperTag = 'div';
    let tag = titleTag;

    if (link !== '') {
        if (linkType === 'box') {
            wrapperTag = 'a';
            tag = 'a';
        } else if (linkType === 'title') {
            tag = 'a';
        } else {
            wrapperTag = 'div';
            tag = titleTag;
        }
    }

    let titleClass = {
        className: classnames({
            'ogb-info-box-title': true,
            [className]: undefined !== className,
        }),
    };

    return (
        <>
            <div {...htmlAttributes}>
                <OGB_Element tagName={wrapperTag} htmlAttrs={wrapperClass}>
                    <div className="ogb-info-box">
                        <div className="ogb-info-box-icon-wrap">
                            {('none' !== type) && (
                                <span className="ogb-info-box-icon">
                                    {text && 'text' === type ?
                                        <span className="ogb-icon-text">
                                            {text}
                                        </span>
                                        : null}

                                    {icon && 'icon' === type ?
                                        <span className="ogb-infobox-icon" dangerouslySetInnerHTML={{ __html: icon }} />
                                        : null}

                                    {mediaUrl && 'image' === type ?
                                        <img {...imgStyle} />
                                        : null}
                                </span>
                            )}
                        </div>

                        <div className="ogb-info-box-content">
                            <OGB_Element tagName={tag} htmlAttrs={titleClass}>
                                {title}
                            </OGB_Element>

                            {titleSeparator && (
                                <div className="ogb-info-box-divider-wrap">
                                    <div className="ogb-info-box-divider"></div>
                                </div>
                            )}

                            {description && (
                                <div className="ogb-info-box-description">
                                    {description}
                                </div>
                            )}

                            {'button' === linkType && (
                                <div className="ogb-info-box-btn-wrap">
                                    <a className="ogb-info-box-button">
                                        {primaryBtnIcon && 'left' === primaryBtnIconPosition ?
                                            <span className="ogb-infobox-btn-icon icon-align-left" dangerouslySetInnerHTML={{ __html: primaryBtnIcon }} />
                                            : null}
                                        {'' !== primaryBtnText && (
                                            <span>{primaryBtnText}</span>
                                        )}
                                        {primaryBtnIcon && 'right' === primaryBtnIconPosition ?
                                            <span className="ogb-infobox-btn-icon icon-align-right" dangerouslySetInnerHTML={{ __html: primaryBtnIcon }} />
                                            : null}
                                    </a>
                                </div>
                            )}
                        </div>
                    </div>
                </OGB_Element>
            </div>
        </>
    );
}

export default ogbInfoBoxSave;

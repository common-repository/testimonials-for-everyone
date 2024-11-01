import {RichText} from '@wordpress/block-editor';

const Save = (props) => {
    const {attributes} = props;
    const {
        content,
        author,
        company,
        link,
        rating,
        starColor,
        starSize,
        showImage,
        showCompany,
        showLink,
        showRating,
        image_url,
        imageSize,
        imageRounded,
        imageAlign,
        backgroundColor,
        borderSize,
        borderColor,
        borderRadius,
    } = attributes;

    const stars = [];
    for (let i = 0; i < rating; i++) {
        stars.push(
            <span
                key={i}
                style={{
                    color: starColor,
                    fontSize: `${starSize}px`,
                }}
            >
                ★
            </span>
        );
    }

    return (
        <div
            style={{
                backgroundColor,
                border: `${borderSize}px solid ${borderColor}`,
                borderRadius: `${borderRadius}px`,
                padding: '10px',
            }}
        >
            {showImage && image_url && (
                <img
                    src={image_url}
                    alt={author}
                    style={{
                        width: `${imageSize}px`,
                        height: `${imageSize}px`,
                        borderRadius: imageRounded ? '50%' : '0',
                        float: imageAlign,
                        marginRight: imageAlign === 'left' ? '10px' : '0',
                        marginLeft: imageAlign === 'right' ? '10px' : '0',
                    }}
                />
            )}
            <RichText.Content tagName="p" className="content" value={content} style={{paddingTop: '10px'}}/>
            <p className="author">{author}</p>
            {showCompany && <p className="company">{company}</p>}
            {showLink && (
                <a className="website-link" href={link}>
                    {link}
                </a>
            )}
            {showRating && <div className="rating">{stars}</div>}
        </div>
    );
};

export default Save;

import { useEffect, useRef } from 'react';
import {RichText} from '@wordpress/block-editor';

const TestimonialItemsDefault = ({
                                     testimonial,
                                     imageAlign,
                                     showImage,
                                     imageSize,
                                     imageRounded,
                                     authorColor,
                                     authorAlign,
                                     companyColor,
                                     companyAlign,
                                     contentColor,
                                     paddingTop,
                                     paddingBottom,
                                     paddingLeft,
                                     paddingRight,
                                     authorFontSize,
                                     companyFontSize,
                                     testimonialFontSize,
                                     authorFontWeight,
                                     companyFontWeight,
                                     testimonialFontWeight,
                                     contentAlign,
                                     starColor,
                                     starSize,
                                     starAligment,
                                     showCompany,
                                     showLink,
                                     showRating,
                                     backgroundColor,
                                     borderSize,
                                     borderColor,
                                     borderRadius,
                                     testimonialsLayout
                                 }) => {


    const testimonialStyle = {
        backgroundColor: backgroundColor,
        borderWidth: borderSize + 'px',
        borderColor: borderColor,
        borderRadius: borderRadius + 'px',
        borderStyle: 'solid',
        paddingTop: paddingTop,
        paddingBottom: paddingBottom,
        paddingLeft: paddingLeft,
        paddingRight: paddingRight,
    };

    return (
        <div className={`testimonial ${imageAlign}`} style={testimonialStyle}>
            {imageAlign === 'left' && (
                <div style={{display: 'flex', alignItems: 'center'}}>
                    {showImage && testimonial.image_url && (
                        <div
                            style={{
                                width: imageSize + 'px',
                                height: imageSize + 'px',
                                backgroundImage: `url(${testimonial.image_url})`,
                                backgroundSize: 'cover',
                                backgroundPosition: 'center',
                                borderRadius: imageRounded ? '50%' : '0',
                                marginRight: imageAlign === 'left' ? '15px' : '0',
                                margin: imageAlign === 'center' ? '0 auto' : '0',
                            }}
                            aria-label={testimonial.author}
                        ></div>
                    )}
                    <div>
                        <span
                            className="author"
                            style={{
                                marginLeft: showImage ? '10px' : '0',
                                color: authorColor,
                                fontSize: authorFontSize + 'px',
                                fontWeight: authorFontWeight
                            }}
                        >
                            {testimonial.author}
                        </span>
                        {testimonial.company && showCompany && (
                            <span
                                className="company"
                                style={{
                                    marginLeft: showImage ? '10px' : '0',
                                    color: companyColor,
                                    fontSize: companyFontSize + 'px',
                                    fontWeight: companyFontWeight
                                }}
                            >
                                {testimonial.company}
                            </span>
                        )}
                    </div>
                </div>
            )}
            {imageAlign === 'center' && (
                <div>
                    <div style={{textAlign: 'center'}}>
                        {showImage && testimonial.image_url && (
                            <div
                                style={{
                                    width: imageSize + 'px',
                                    height: imageSize + 'px',
                                    backgroundImage: `url(${testimonial.image_url})`,
                                    backgroundSize: 'cover',
                                    backgroundPosition: 'center',
                                    borderRadius: imageRounded ? '50%' : '0',
                                    marginRight: imageAlign === 'left' ? '15px' : '0',
                                    margin: imageAlign === 'center' ? '0 auto' : '0',
                                }}
                                aria-label={testimonial.author}
                            ></div>
                        )}
                    </div>
                    <span className="author"
                          style={{
                              color: authorColor,
                              textAlign: authorAlign,
                              fontSize: authorFontSize + 'px',
                              fontWeight: authorFontWeight
                          }}>
                        {testimonial.author}
                    </span>
                    {testimonial.company && (
                        <span className="company" style={{
                            color: companyColor,
                            textAlign: companyAlign,
                            fontSize: companyFontSize + 'px',
                            fontWeight: companyFontWeight
                        }}>
                            {testimonial.company}
                        </span>
                    )}
                </div>
            )}
            {imageAlign === 'right' && (
                <div style={{display: 'flex', alignItems: 'center', marginLeft: 'auto', flexDirection: 'row-reverse'}}>
                    {showImage && testimonial.image_url && (
                        <div
                            style={{
                                width: imageSize + 'px',
                                height: imageSize + 'px',
                                backgroundImage: `url(${testimonial.image_url})`,
                                backgroundSize: 'cover',
                                backgroundPosition: 'center',
                                borderRadius: imageRounded ? '50%' : '0',
                            }}
                            aria-label={testimonial.author}
                        ></div>
                    )}
                    <div
                        style={{
                            textAlign: showImage && imageAlign === 'right' ? 'right' : 'left',
                            marginRight: showImage && imageAlign === 'right' ? '15px' : '0',
                        }}
                    >
                        <span
                            className="author"
                            style={{
                                marginRight: showImage ? '10px' : '0',
                                color: authorColor,
                                fontSize: authorFontSize + 'px',
                                fontWeight: authorFontWeight
                            }}
                        >
                            {testimonial.author}
                        </span>
                        {testimonial.company && (
                            <span
                                className="company"
                                style={{
                                    marginRight: showImage ? '10px' : '0',
                                    color: companyColor,
                                    fontSize: companyFontSize + 'px',
                                    fontWeight: companyFontWeight
                                }}
                            >
                                {testimonial.company}
                            </span>
                        )}
                    </div>
                </div>
            )}
            <RichText.Content
                tagName="p"
                className="content"
                value={testimonial.content}
                style={{
                    marginTop: '10px',
                    color: contentColor,
                    fontSize: testimonialFontSize,
                    textAlign: contentAlign,
                fontWeight: testimonialFontWeight}}
            />
            {testimonial.rating && showRating && (
                <div className="rating" style={{color: starColor, fontSize: starSize, textAlign: starAligment}}>
                    {'★'.repeat(testimonial.rating)}
                    {'☆'.repeat(5 - testimonial.rating)}
                </div>
            )}
        </div>
    );
};

export default TestimonialItemsDefault;

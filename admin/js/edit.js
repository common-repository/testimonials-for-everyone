import {useState, useEffect} from '@wordpress/element';
import {RichText, InspectorControls} from '@wordpress/block-editor';
import {
    PanelBody, RangeControl,
    TabPanel,
} from '@wordpress/components';
import {__} from '@wordpress/i18n';
import {withSelect} from '@wordpress/data';
import SettingsPanel from './components/SettingsPannel';
import BackgroundSettingsPanel from './components/BackgroundSettingsPanel';
import StyleSettingsPanel from './components/StylingSettingsPanel';
import SpacingsPanel from "./components/SpacingsPanel";
import ShortcodePanel from "./components/ShortcodePanel";
import ManageTestimonialsPanel from './components/ManageTestimonialsPanel';
import TestimonialItemsDefault from "./components/TestimonialItemsDefault";
import React from "react";

const getSerializableTestimonials = (testimonials) => {
    if (!Array.isArray(testimonials)) {
        return [];
    }
    return testimonials.map(({id, image_url, author, company, content, link, rating, order}) => ({
        id,
        image_url,
        author,
        company,
        content,
        link,
        rating,
        order
    }));
};

const Edit = withSelect((select) => {
    const testimonials = select('core')?.getEntityRecords ? select('core').getEntityRecords('postType', 'testimonial') : [];
    return {
        testimonials: testimonials || [],
    };
})(({attributes, setAttributes, testimonials, className}) => {
    const {
        content,
        author,
        company,
        link,
        rating,
        starColor,
        starSize,
        starAligment,
        showImage,
        showCompany,
        showLink,
        showRating,
        image_url,
        imageSize,
        imageRounded,
        imageAlign,
        authorAlign,
        companyAlign,
        contentAlign,
        backgroundColor,
        borderSize,
        borderColor,
        borderRadius,
        authorColor,
        companyColor,
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
        testimonialsLayout,
        testimonialsNumberInGrid
    } = attributes;

    const [testimonialList, setTestimonialList] = useState([]);
    const [isLoading, setIsLoading] = useState(true);
    const [activeTab, setActiveTab] = useState('settings');
    const [expandedTestimonials, setExpandedTestimonials] = useState([]);
    const [postId, setPostId] = useState(null);

    useEffect(() => {
        const currentPostId = wp.data.select('core/editor').getCurrentPostId();
        setPostId(currentPostId);

        fetchTestimonials();
    }, []);

    const fetchTestimonials = () => {
        const postId = wp.data.select("core/editor").getCurrentPostId();

        fetch(ajaxurl, {
            method: 'POST',
            body: new URLSearchParams({
                action: 'wpte_fetch_testimonials',
                post_id: postId, // Include the post ID
            }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const testimonialsData = Array.isArray(data.data) ? data.data : [];
                    setTestimonialList(testimonialsData);
                    setIsLoading(false);
                }
            });
    };

    const handlePanelClick = (panelName) => {
        setActiveTab(panelName);
    };

    const addTestimonial = () => {
        const newTestimonial = {
            id: null,
            image_url: '',
            author: '',
            company: '',
            content: '',
            link: '',
            rating: 5,
            order: testimonialList.length
        };

        setTestimonialList([...testimonialList, newTestimonial]);
        setExpandedTestimonials([...expandedTestimonials, testimonialList.length]);
    };

    const deleteTestimonial = (id, index) => {
        if (id) {
            const data = new FormData();
            data.append('action', 'wpte_delete_testimonial');
            data.append('id', id);

            fetch(ajaxurl, {
                method: 'POST',
                body: data,
            })
                .then(response => response.json())
                .then(response => {
                    if (response.success) {
                        const newTestimonialList = [...testimonialList];
                        newTestimonialList.splice(index, 1);
                        setTestimonialList(newTestimonialList);
                    } else {
                        alert(__('Error deleting testimonial', 'testimonials-for-everyone'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert(__('Error deleting testimonial', 'testimonials-for-everyone'));
                });
        } else {
            const newTestimonialList = [...testimonialList];
            newTestimonialList.splice(index, 1);
            setTestimonialList(newTestimonialList);
        }
    };

    const saveTestimonials = (reorderedTestimonials = null) => {
        const postId = wp.data.select("core/editor").getCurrentPostId(); // Get the current post ID
        const isValidArray = Array.isArray(reorderedTestimonials) && reorderedTestimonials.every(item => item.hasOwnProperty('id') && item.hasOwnProperty('order'));
        const testimonialsToSave = isValidArray ? getSerializableTestimonials(reorderedTestimonials) : getSerializableTestimonials(testimonialList);

        const data = new FormData();
        data.append('action', 'wpte_save_testimonials');
        data.append('testimonials', JSON.stringify(testimonialsToSave));
        data.append('post_id', postId);

        fetch(ajaxurl, {
            method: 'POST',
            body: data,
        })
            .then(response => response.json())
            .then(response => {
                if (response.success) {
                    setTestimonialList(testimonialList);
                    alert(__('Testimonials saved successfully', 'testimonials-for-everyone'));
                    fetchTestimonials();
                } else {
                    alert(__('Error saving testimonials', 'testimonials-for-everyone'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(__('Error saving testimonials', 'testimonials-for-everyone'));
            });
    };

    const toggleExpandTestimonial = (index) => {
        setExpandedTestimonials((prevExpanded) =>
            prevExpanded.includes(index)
                ? prevExpanded.filter((i) => i !== index)
                : [...prevExpanded, index]
        );
    };

    const onDragEnd = (result) => {
        if (!result.destination) {
            return;
        }

        const reorderedTestimonials = Array.from(testimonialList);
        const [movedTestimonial] = reorderedTestimonials.splice(result.source.index, 1);
        reorderedTestimonials.splice(result.destination.index, 0, movedTestimonial);

        // Update the order property based on the new order
        const updatedTestimonials = reorderedTestimonials.map((testimonial, index) => ({
            ...testimonial,
            order: index
        }));

        setTestimonialList(updatedTestimonials);
        saveTestimonials(updatedTestimonials);
    };


    return (
        <div className={className}>
            <InspectorControls>
                <TabPanel
                    className="my-tab-panel wppfe-tabs-all"
                    activeClass="active-tab"
                    initialTabName={activeTab}
                    onSelect={(tabName) => handlePanelClick(tabName)}
                    tabs={[
                        {
                            name: 'settings',
                            title: __('Settings', 'testimonials-for-everyone'),
                            className: 'tab-settings wppfe-blocks-tabs',
                        },
                        {
                            name: 'testimonials',
                            title: __('Testimonials', 'testimonials-for-everyone'),
                            className: 'tab-testimonials wppfe-blocks-tabs',
                        },
                        {
                            name: 'layout',
                            title: __('Layout', 'testimonials-for-everyone'),
                            className: 'tab-layout wppfe-blocks-tabs',
                        }
                    ]}
                >
                    {(tab) => (
                        <div>
                            {tab.name === 'settings' && (
                                <>
                                    <SettingsPanel
                                        attributes={attributes}
                                        setAttributes={setAttributes}
                                        activeTab={activeTab}
                                        handlePanelClick={handlePanelClick}
                                    />
                                    <BackgroundSettingsPanel
                                        attributes={attributes}
                                        setAttributes={setAttributes}
                                        activeTab={activeTab}
                                        handlePanelClick={handlePanelClick}
                                    />
                                    <StyleSettingsPanel
                                        attributes={attributes}
                                        setAttributes={setAttributes}
                                        activeTab={activeTab}
                                        handlePanelClick={handlePanelClick}
                                    />
                                    <SpacingsPanel
                                        attributes={attributes}
                                        setAttributes={setAttributes}
                                        activeTab={activeTab}
                                        handlePanelClick={handlePanelClick}
                                    />
                                    <ShortcodePanel
                                        attributes={attributes}
                                        postId={postId}
                                        activeTab={activeTab}
                                        handlePanelClick={handlePanelClick}
                                    />
                                </>
                            )}
                            {tab.name === 'testimonials' && (
                                <>
                                    <ManageTestimonialsPanel
                                        testimonialList={testimonialList}
                                        setTestimonialList={setTestimonialList}
                                        expandedTestimonials={expandedTestimonials}
                                        toggleExpandTestimonial={toggleExpandTestimonial}
                                        deleteTestimonial={deleteTestimonial}
                                        addTestimonial={addTestimonial}
                                        saveTestimonials={saveTestimonials}
                                        isLoading={isLoading}
                                        onDragEnd={onDragEnd}
                                        handlePanelClick={handlePanelClick}
                                        activeTab={activeTab}
                                    />
                                </>
                            )}
                            {tab.name === 'layout' && (
                                <PanelBody
                                    title={__('Layout', 'testimonials-for-everyone')}
                                    onToggle={() => handlePanelClick('layout')}
                                    initialOpen={true}
                                    style={{
                                        borderBottom: activeTab === 'testimonials' ? '2px solid #007cba' : 'none',
                                    }}
                                >
                                    <SelectControl
                                        label={__('Select Layout', 'wp-testimonials-for-everyone')}
                                        value={testimonialsLayout}
                                        options={[
                                            {label: __('Standard', 'testimonials-for-everyone'), value: 'standard'},
                                            {label: __('Grid', 'testimonials-for-everyone'), value: 'grid'}
                                        ]}
                                        onChange={(value) => setAttributes({testimonialsLayout: value})}
                                    />
                                    {(testimonialsLayout === 'grid' || testimonialsLayout === 'masonry') && (
                                        <RangeControl
                                            label={__('Testimonial amount In One Line', 'testimonials-for-everyone')}
                                            value={testimonialsNumberInGrid}
                                            onChange={(value) => setAttributes({testimonialsNumberInGrid: value})}
                                            min={2}
                                            max={10}
                                        />
                                    )}
                                </PanelBody>
                            )}
                        </div>
                    )}
                </TabPanel>
            </InspectorControls>
            <div className={`wpte-testimonials ${testimonialsLayout}`} style={
                testimonialsLayout === 'grid' ? {
                    columnCount: `${testimonialsNumberInGrid}`,
                    gridTemplateColumns: `repeat(${testimonialsNumberInGrid}, 1fr)`
                } : {}
            }>
                {isLoading ? (
                    <p>{__('Loading testimonials...', 'testimonials-for-everyone')}</p>
                ) : testimonialList.length === 0 ? (
                    <p>{__('No testimonials yet', 'testimonials-for-everyone')}</p>
                ) : (
                    testimonialList.map((testimonial, index) => (
                        <>
                            <TestimonialItemsDefault
                                key={testimonial.id || index}
                                testimonial={testimonial}
                                imageAlign={imageAlign}
                                showImage={showImage}
                                imageSize={imageSize}
                                imageRounded={imageRounded}
                                authorColor={authorColor}
                                authorAlign={authorAlign}
                                companyColor={companyColor}
                                companyAlign={companyAlign}
                                contentColor={contentColor}
                                paddingTop={paddingTop}
                                paddingBottom={paddingBottom}
                                paddingLeft={paddingLeft}
                                paddingRight={paddingRight}
                                authorFontSize={authorFontSize}
                                companyFontSize={companyFontSize}
                                testimonialFontSize={testimonialFontSize}
                                authorFontWeight={authorFontWeight}
                                companyFontWeight={companyFontWeight}
                                testimonialFontWeight={testimonialFontWeight}
                                contentAlign={contentAlign}
                                starColor={starColor}
                                starSize={starSize}
                                starAligment={starAligment}
                                showCompany={showCompany}
                                showLink={showLink}
                                showRating={showRating}
                                backgroundColor={backgroundColor}
                                borderSize={borderSize}
                                borderColor={borderColor}
                                borderRadius={borderRadius}
                                testimonialsLayout={testimonialsLayout}
                            />
                        </>
                    ))
                )}
            </div>
        </div>
    );
});

export default Edit;

import React from 'react';
import { PanelBody, TextControl, Button, RangeControl, Dashicon } from '@wordpress/components';
import { MediaUpload, RichText } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { DragDropContext, Droppable, Draggable } from 'react-beautiful-dnd';

const ManageTestimonialsPanel = ({
                                     testimonialList,
                                     setTestimonialList,
                                     expandedTestimonials,
                                     toggleExpandTestimonial,
                                     deleteTestimonial,
                                     addTestimonial,
                                     saveTestimonials,
                                     isLoading,
                                     onDragEnd,
                                     handlePanelClick,
                                     activeTab
                                 }) => (
    <PanelBody
        title={__('Manage Testimonials', 'testimonials-for-everyone')}
        onToggle={() => handlePanelClick('testimonials')}
        style={{
            borderBottom: activeTab === 'testimonials' ? '2px solid #007cba' : 'none',
        }}
    >
        {isLoading ? (
            <p>{__('Loading testimonials...', 'wp-testimonials-for-everyone')}</p>
        ) : (
            <DragDropContext onDragEnd={onDragEnd}>
                <Droppable droppableId="testimonials">
                    {(provided) => (
                        <div {...provided.droppableProps} ref={provided.innerRef}>
                            {testimonialList.map((testimonial, index) => (
                                <Draggable key={testimonial.id || index} draggableId={`${testimonial.id || index}`} index={index}>
                                    {(provided) => (
                                        <div ref={provided.innerRef} {...provided.draggableProps} {...provided.dragHandleProps}>
                                            <PanelBody
                                                title={<><Dashicon icon="menu" style={{ marginRight: '10px' }} />{testimonial.author || __('New Testimonial', 'wp-testimonials-for-everyone')}</>}
                                                initialOpen={expandedTestimonials.includes(index)}
                                                onToggle={() => toggleExpandTestimonial(index)}
                                            >
                                                <div className="testimonial-item">
                                                    <span>Image</span>
                                                    <br />
                                                    <MediaUpload
                                                        onSelect={(media) => {
                                                            const newTestimonialList = [...testimonialList];
                                                            newTestimonialList[index].image_url = media.url;
                                                            setTestimonialList(newTestimonialList);
                                                        }}
                                                        allowedTypes={['image']}
                                                        value={testimonial.image_url}
                                                        render={({ open }) => (
                                                            <Button onClick={open}>
                                                                {__('Upload Image', 'wp-testimonials-for-everyone')}
                                                            </Button>
                                                        )}
                                                    />
                                                    {testimonial.image_url && (
                                                        <img src={testimonial.image_url} alt={testimonial.author}
                                                             style={{
                                                                 maxWidth: '100%',
                                                                 height: 'auto'
                                                             }} />
                                                    )}
                                                    <TextControl
                                                        label={__('Author', 'wp-testimonials-for-everyone')}
                                                        value={testimonial.author}
                                                        onChange={(value) => {
                                                            const newTestimonialList = [...testimonialList];
                                                            newTestimonialList[index].author = value;
                                                            setTestimonialList(newTestimonialList);
                                                        }}
                                                    />
                                                    <TextControl
                                                        label={__('Company', 'wp-testimonials-for-everyone')}
                                                        value={testimonial.company}
                                                        onChange={(value) => {
                                                            const newTestimonialList = [...testimonialList];
                                                            newTestimonialList[index].company = value;
                                                            setTestimonialList(newTestimonialList);
                                                        }}
                                                    />
                                                    <span>Content</span>
                                                    <br />
                                                    <RichText
                                                        tagName="p"
                                                        value={testimonial.content}
                                                        onChange={(value) => {
                                                            const newTestimonialList = [...testimonialList];
                                                            newTestimonialList[index].content = value;
                                                            setTestimonialList(newTestimonialList);
                                                        }}
                                                        placeholder={__('Add testimonial content...', 'wp-testimonials-for-everyone')}
                                                    />
                                                    <RangeControl
                                                        label={__('Rating', 'wp-testimonials-for-everyone')}
                                                        value={Number(testimonial.rating) || 0} // Convert to number
                                                        onChange={(value) => {
                                                            const newTestimonialList = [...testimonialList];
                                                            newTestimonialList[index].rating = value;
                                                            setTestimonialList(newTestimonialList);
                                                        }}
                                                        min={1}
                                                        max={5}
                                                    />
                                                    <Button isDestructive onClick={() => deleteTestimonial(testimonial.id, index)}>
                                                        {__('Delete', 'wp-testimonials-for-everyone')}
                                                    </Button>
                                                </div>
                                            </PanelBody>
                                        </div>
                                    )}
                                </Draggable>
                            ))}
                            {provided.placeholder}
                        </div>
                    )}
                </Droppable>
            </DragDropContext>
        )}
        <Button isPrimary onClick={addTestimonial}>
            {__('Add More', 'wp-testimonials-for-everyone')}
        </Button>
        &nbsp;&nbsp;&nbsp;
        <Button isPrimary onClick={saveTestimonials}>
            {__('Save Testimonials', 'wp-testimonials-for-everyone')}
        </Button>
    </PanelBody>
);

export default ManageTestimonialsPanel;

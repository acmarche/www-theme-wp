const { useEffect } = wp.element;

function Description( props ) {
    useEffect( () => {
        if ( 0 !== props.selectedCategory ) {
            const filteredCategoryDescription = props.categories.filter( ( object ) => object.id == props.selectedCategory );
            props.setFilteredCategoryDescription(
                filteredCategoryDescription[0].description
            );
        } else {
            props.setFilteredCategoryDescription( '' );
        }
    }, [ props.categories, props.selectedCategory ]);

    if ( '' !== props.filteredCategoryDescription ) {
        return (
            <p
                dangerouslySetInnerHTML={{
                    __html: props.filteredCategoryDescription
                }}
            />
        );
    }
    return null;
}

export default Description;

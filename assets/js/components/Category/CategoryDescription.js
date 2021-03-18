function CategoryDescription( propos ) {
    const { category } = propos;

    function createMarkup() {
        return { __html: category?.description };
    }

    if ( 0 < category.description.length ) {
        return (
            <>
                <p className={'mt-2'} dangerouslySetInnerHTML={createMarkup()}/>
            </>
        );
    }
    return (
        <>

        </>
    );
}

export default CategoryDescription;

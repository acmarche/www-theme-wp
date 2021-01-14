function CategoryItem( propos ) {
    const { item } = propos;

    function handleClick( categoryId, categoryTitle ) {
        propos.setItemActive( categoryId );
        propos.setSelectedCategory( categoryId );
        propos.setSelectedCategoryTitle( categoryTitle );
        document.title = categoryTitle;
    }

    return (
        <li
            className={`${item.active ? 'active' : ''} pr-24px`}
        >
            <a
                data-category-id={item.id}
                onClick={( ( ) => handleClick( item.id, item.name ) )}
                href="#"
            >
                {item.name} {item.id}
            </a>
        </li>
    );
}

export default CategoryItem;

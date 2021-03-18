function CategoryItem( propos ) {
    const { item } = propos;

    function handleClick( categoryId ) {
        propos.setItemActive( categoryId );
        propos.setSelectedCategory( categoryId );
    }

    return (
        <li
            className={`${item.active ? 'active' : ''} pr-24px`}
        >
            <a
                data-category-id={item.id}
                onClick={( ( ) => handleClick( item.id ) )}
                href="#"
            >
                {item.name}
            </a>
        </li>
    );
}

export default CategoryItem;

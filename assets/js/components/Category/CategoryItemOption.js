function CategoryItemOption( propos ) {
    const { item } = propos;

    function handleClick( categoryId, categoryTitle ) {
        propos.setItemActive( categoryId );
        propos.setSelectedCategory( categoryId );
        propos.setSelectedCategoryTitle( categoryTitle );
        document.title = categoryTitle;
    }

    return (
        <option
            key={item.id + 1000}
            value={item.id}
            data-category-id={item.id}
            defaultValue={item.active}
        >
            {item.name}
        </option>
    );
}

export default CategoryItemOption;

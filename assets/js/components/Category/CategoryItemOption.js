function CategoryItemOption( propos ) {
    const { item } = propos;
    return (
        <option
            key={item.id + 1000}
            value={item.id}
            data-category-id={item.id}
            data-category-name={item.name}
            defaultValue={item.active}
        >
            {item.name}
        </option>
    );
}

export default CategoryItemOption;

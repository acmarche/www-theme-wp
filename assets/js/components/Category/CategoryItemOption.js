function CategoryItemOption( propos ) {
    const { item } = propos;
    return (
        <option
            key={item.id}
            value={item.id}
        >
            {item.name}
        </option>
    );
}

export default CategoryItemOption;

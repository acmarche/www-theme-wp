function CategoryItemOption( propos ) {
    const { item } = propos;
    if ( null == item ) {
        return ( <option
            key={0}
            value={0}
        >
            Tout
        </option> );
    }

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

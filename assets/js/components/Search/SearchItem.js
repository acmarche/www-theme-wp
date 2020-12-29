function SearchItem( propos ) {
    const { item } = propos;
    return (
        <>
            <li className="pb-12px px-12px col-12 col-md-6">
                <a href={item.url} className="border border-default p-24px shadow-sm d-block">
                    <h3 className="fs-short-2 ff-semibold text-dark-primary text-hover-primary transition-all ellipsis">
                        {item.name}
                    </h3>
                    <span className="d-block pt-8px fs-short-3 ellipsis text-dark-primary">{item.excerpt}</span>
                </a>
            </li>
        </>
    );
}

export default SearchItem;

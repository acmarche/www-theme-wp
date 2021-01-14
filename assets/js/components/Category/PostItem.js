function PostItem( propos ) {
    const { item } = propos;
    return (
        <li className="pb-12px px-12px col-12 col-md-6">
            <a
                href={item.link}
                className="border border-default p-24px shadow-sm d-block"
            >
                <h3
                    className="fs-short-2 ff-semibold text-dark-primary text-hover-primary transition-all ellipsis"
                    dangerouslySetInnerHTML={{
                        __html: item.post_title
                    }}
                />
                <span
                    className="d-block pt-8px fs-short-3 ellipsis text-dark-primary"
                    dangerouslySetInnerHTML={{
                        __html: item.excerpt
                    }}
                />
            </a>
        </li>
    );
}

export default PostItem;

function CategoryTitle( propos ) {
    const { category } = propos;
    return (
        <>
            <span className={`${propos.color} ff-semibold pt-12px d-block fs-short-2`}>{category && category.name}</span>
        </>
    );
}

export default CategoryTitle;

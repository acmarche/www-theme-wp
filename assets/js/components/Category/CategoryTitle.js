function CategoryTitle( propos ) {
    return (
        <>
            <span className={`${propos.color} ff-semibold pt-12px d-block fs-short-2`}>{propos.title}</span>
        </>
    );
}

export default CategoryTitle;

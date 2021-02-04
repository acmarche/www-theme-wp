import CategoryChildren from './CategoryChildren';
import PostResults from './PostResults';
import CategoryTitle from './CategoryTitle';

const {
    useState,
    useEffect
} = wp.element;

function Category() {
    const [ selectedCategory, setSelectedCategory ] = useState( 0 );
    const [ selectedCategoryTitle, setSelectedCategoryTitle ] = useState( '' );
    const name = 'app-category';

    const mainCategory = document.getElementById( name )
        .getAttribute( 'data-main-category-id' );
    const siteSlug = document.getElementById( name )
        .getAttribute( 'data-site-slug' );
    const color = document.getElementById( name )
        .getAttribute( 'data-color' );
    const categoryTitle = document.getElementById( name )
        .getAttribute( 'data-site-name' );

    useEffect( () => {
        setSelectedCategory( mainCategory );
        setSelectedCategoryTitle( categoryTitle );
    }, []);

    return (
        <>
            <CategoryTitle title={selectedCategoryTitle} color={color}/>
            <CategoryChildren
                catId={mainCategory}
                siteSlug={siteSlug}
                setSelectedCategory={setSelectedCategory}
                setSelectedCategoryTitle={setSelectedCategoryTitle} />
            <PostResults catId={selectedCategory} siteSlug={siteSlug}/>
        </>
    );
}

export default Category;

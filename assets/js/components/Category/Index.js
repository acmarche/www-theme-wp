import CategoryChildren from './CategoryChildren';
import { fetchCategory } from './service/categories-service';
import PostResults from './PostResults';
import CategoryTitle from './CategoryTitle';
import CategoryDescription from './CategoryDescription';

const {
    useState,
    useEffect
} = wp.element;

function Category() {
    const [ selectedCategory, setSelectedCategory ] = useState( 0 );
    const [ category, setCategory ] = useState( null );
    const name = 'app-category';

    const mainCategory = document.getElementById( name )
        .getAttribute( 'data-main-category-id' );
    const siteSlug = document.getElementById( name )
        .getAttribute( 'data-site-slug' );
    const color = document.getElementById( name )
        .getAttribute( 'data-color' );

    async function loadCategory() {
        if ( 0 < selectedCategory ) {
            let response;
            try {
                response = await fetchCategory( siteSlug, selectedCategory );
                setCategory( response.data );
                document.title = response.data.name;
            } catch ( e ) {
                console.log( e );
            }
        }
        return null;
    }

    useEffect( () => {
        setSelectedCategory( mainCategory );
    }, []);

    useEffect( () => {
        loadCategory();
    }, [ selectedCategory ]);
    return (
        <>
            <CategoryTitle category={category} color={color}/>
            <CategoryChildren
                catId={mainCategory}
                siteSlug={siteSlug}
                setSelectedCategory={setSelectedCategory}/>
            {category && <CategoryDescription category={category}/>}
            <PostResults catId={selectedCategory} siteSlug={siteSlug}/>
        </>
    );
}

export default Category;

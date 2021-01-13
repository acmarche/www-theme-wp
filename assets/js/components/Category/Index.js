import Top from './Top';
import Category from './Category';
import Description from './Description';
import Results from './Results';

const {
    useState,
    useEffect
} = wp.element;

function App() {
    const [ siteSlug, setSiteSlug ] = useState( '' ); //starting url request (HTML)
    const [ mainCategoryId, setMainCategoryId ] = useState( 0 ); //narrow down request (HTML)

    useEffect( () => {
        const adaptSiteSlug = ( tempSiteSlug ) => ( '/citoyen/' === tempSiteSlug ? '' : tempSiteSlug );
        setSiteSlug(
            adaptSiteSlug(
                document.querySelector( '#app-category' )
                    .getAttribute( 'data-site-url' )
            )
        );
        setMainCategoryId(
            document.querySelector( '#app-category' )
                .getAttribute( 'data-main-category-id' )
        );
    }, []);

    const [ categories, setCategories ] = useState([]);
    const [ categoriesIds, setCategoriesIds ] = useState([]);
    const [ selectedCategory, setSelectedCategory ] = useState( 0 );
    const [ posts, setPosts ] = useState([]);
    const [ filteredPosts, setFilteredPosts ] = useState([]);
    const [
        filteredCategoryDescription,
        setFilteredCategoryDescription
    ] = useState( '' );

    return (
        <>
            <Top siteSlug={siteSlug} mainCategoryId={mainCategoryId}/>

            <Category
                siteSlug={siteSlug}
                mainCategoryId={mainCategoryId}
                categories={categories}
                setCategories={setCategories}
                setCategoriesIds={setCategoriesIds}
                setSelectedCategory={setSelectedCategory}
            />

            <Description
                categories={categories}
                selectedCategory={selectedCategory}
                filteredCategoryDescription={filteredCategoryDescription}
                setFilteredCategoryDescription={setFilteredCategoryDescription}
            />

            <Results
                siteSlug={siteSlug}
                mainCategoryId={mainCategoryId}
                categoriesIds={categoriesIds}
                posts={posts}
                setPosts={setPosts}
                selectedCategory={selectedCategory}
                filteredPosts={filteredPosts}
                setFilteredPosts={setFilteredPosts}
            />
        </>
    );
}

export default App;

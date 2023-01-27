<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <body>
                <h2>Book Catalog</h2>
                <table border="1">
                <tr>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Price</th>
                    <th>Publish Date</th>
                    <th>Description</th>
                </tr>
                <xsl:for-each select="catalog/book">
                    <tr>
                        <td><xsl:value-of select="author"/></td>
                        <td><xsl:value-of select="title"/></td>
                        <td><xsl:value-of select="genre"/></td>
                        <td><xsl:value-of select="price"/></td>
                        <td><xsl:value-of select="publish_date"/></td>
                        <td><xsl:value-of select="description"/></td>
                    </tr>
                </xsl:for-each>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>